<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\SubCategories;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categories::with('sub_categories')->paginate(5);
        //dd($cat);
        return view('adm.cat.index', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adm.cat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = new Categories();
        $cat->name = Str::title($request->name);
        if(!empty($request->slug)) {
            $cat->slug = Str::slug($request->slug, '-');
        } else {
            $cat->slug = Str::slug($request->name);
        }
        $cat->save();

        return redirect()->route('admin.cat.index')->with('status', 'Categorie adaugat cu succes !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('adm.cat.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('adm.cat.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sub_store(Request $request)
    {
        $parent = $request->parent;
        $cat = new SubCategories();
        $cat->name = Str::title($request->name);
        $cat->slug = Str::slug($request->name, '-');
        $cat->categories_id = $parent;
        $cat->save();

        $cats = Categories::find($parent);
        $cats->sub_categories()->attach($cat->id);

        return redirect()->route('admin.cat.index')->with('status', 'Sub Categorie adaugata cu succes la categoria '. $cats->name .' !');
    }

    public function sub_create(Categories $cat)
    {
        return view('adm.cat.sub', compact('cat'));
    }

    public function sub_destroy($id)
    {
        
    }
}
