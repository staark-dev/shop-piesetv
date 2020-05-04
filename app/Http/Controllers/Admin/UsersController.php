<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('roles')->paginate(5);
        //dd($user[0]->roles);
        return view('adm.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \App\Role::all();
        return view('adm.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:65',
            'last_name' => 'required|string|max:65',
            'user_name' => 'required|string|max:65',
            'email' => 'required|string|max:128|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $roleId = $request->input('rol');

        $uID = User::insertGetId([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->user_name,
            'email' => $request->email,
            'role_id' => (!empty($roleId) ? '2' : $roleId),
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        if($request->input('status') == 1) {
            $user = User::find($uID);
            $user->update(['email_verified_at' => Carbon::now()]);
        }

        if($request->input('rol') != 0) {
            $user = User::find($uID);
            $user->roles()->attach($roleId);
        } else {
            $user = User::find($uID);
            $user->roles()->attach(2);
        }

        return redirect()->route('admin.user.index')->with('status', 'Utilizator creat cu success.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = \App\Role::all();
        return view('adm.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = null;
        if(Auth::user()->id != 1 && $id == 1) {
            return redirect()->route('admin.user.index')->with('noAccess', '(!) Nu ai dreptul de a edita un cont de developer.');
        }

        if( (Auth::user()->id != 1 || Auth::user()->id != 2) && $id == 2) {
            if( (Auth::user()->id == 2 && $id == 2) || (Auth::user()->id == 1 && $id == 1)) {
                $errors = true;
            } elseif(Auth::user()->id == 1 && $id == 2) {
                $errors = true;
            } else {
                return redirect()->route('admin.user.index')->with('noAccess', '(!) Nu ai dreptul de a edita un cont de CEO.');
            }
        }

        if($request->only('page_profile'))
        {
            $validator = Validator::make($request->all(), [
                'user_name' => 'required|string|max:64',
                'user_avatar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            if($validator->passes()) {

                // dd($request->file('user_avatar'));
                // user_avatar
                if( $request->hasfile('user_avatar') ) {
                    $image = $request->file('user_avatar');
                    $imageName = uniqid() . '.'. $image->getClientOriginalExtension();
                    $postImage = Image::make($image)->resize(150, 150)->save();
                    Storage::disk('public')->put('profile/' . $imageName, $postImage);

                    $user = User::find($id);
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->user_mail;
                    $user->city = $request->oras;
                    $user->judet = $request->judet;
                    $user->telefon = $request->phone;
                    $user->updated_at = Carbon::now();
                    $user->avatar = 'profile/' . $imageName;
                    $user->save();

                    return redirect()->route('admin.user.index')->with('status', 'Contul utilizatorului actualizat cu succes !');
                } else {
                    $user = User::find($id);
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->user_mail;
                    $user->city = $request->oras;
                    $user->judet = $request->judet;
                    $user->telefon = $request->phone;
                    $user->updated_at = Carbon::now();
                    //$user->avatar = 'profile/' . $imageName;
                    $user->save();
                    return redirect()->route('admin.user.index')->with('status', 'Contul utilizatorului actualizat cu succes !');
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->only('page_roles'))
        {
            if(isset($errors) && $errors == true) {
                $user = User::find($id);
                $user->roles()->detach($user->role_id);
                $user->roles()->attach($request->roles);
                $user->role_id = $request->roles;
                $user->save();
                return redirect()->route('admin.user.index')->with('status', 'Contul utilizatorului actualizat cu succes !');
            }

            $user = User::find($id);
            $user->roles()->detach($user->role_id);
            $user->roles()->attach($request->roles);
            $user->role_id = $request->roles;
            $user->save();
            return redirect()->route('admin.user.index')->with('status', 'Contul utilizatorului actualizat cu succes !');
        }

        if($request->only('page_reset_password'))
        {
            $user = User::find($id);

            $validator = Validator::make($request->all(), [
                'user_password' => 'required|min:8',
                'user_password_confirm' =>'required|min:8|same:user_password'
            ]);

            if($validator->passes()) {
                $user->update(['password' => Hash::make($request->user_password)]);
                return redirect()->back();
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != 1 && $id != null) {
            $user = User::find($id);
            $user->roles()->detach();
            $user->delete();
        }
    }

    public function activate(Request $request, $id)
    {
        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        $user->save();
        return redirect()->route('admin.user.index')->with('status', 'Contul utilizatorului activat cu succes !');
    }
}
