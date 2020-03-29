<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['categories','subCategories'])->orderBy('id', 'desc')->paginate(5);
        return view('adm.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = \App\Categories::with('sub_categories')->get();
        return view('adm.product.create', compact('cat'));
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
            'title' => 'required|string|max:128|unique:products',
            'categories' => 'required|string',
            'product_body' => 'required|string',
            'product_price' => 'required|string|max:4|min:2',
            'product_stock' => 'required|string|max:2|min:1',
            'product_gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image' => 'required',
            'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('product_gallery')){
            foreach($request->file('product_gallery') as $file)
            {
                $slug = Str::slug($request->title);
                $currentDate = Carbon::now()->toDateString();
                $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
                
                $postImage = Image::make($file)->resize(1024, 1024)->save();
                Storage::disk('public')->put('images/items/' . $imageName, $postImage);

                $data[] = $imageName;  
            }

            $file = new File();
            $file->filenames = json_encode($data);

            $image = $request->file('product_image');
            $slug = Str::slug($request->title);
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    
            $postImage = Image::make($image)->save();
            Storage::disk('public')->put('images/items/' . $imageName, $postImage);

            $pID = Product::insertGetId([
                'title' => $request->title,
                'image' => $imageName,
                'gallery' => $file->filenames,
                'phone' => $request->product_telefon,
                'slug' => Str::slug($request->title, '-'),
                'categories_id' => $request->categories,
                'sub_categories_id' => (!empty($request->sub_categories) ? null : $request->sub_categories),
                'stock' => $request->product_stock,
                'price' => $request->product_price,
                'description' => $request->product_body,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if(!empty($request->sub_categories)) {
                DB::table('product_sub_categories')->insert(
                    ['product_id' => $pID, 'sub_categories_id' => $request->sub_categories]
                );
            }

            return redirect()->route('admin.product.index');
        } elseif($request->hasfile('product_image')) {
            // Upload Image to local storage
            $image = $request->file('product_image');
            $slug = Str::slug($request->title);
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    
            $postImage = Image::make($image)->save();
            Storage::disk('public')->put('images/items/' . $imageName, $postImage);

            $pID = Product::insertGetId([
                'title' => $request->title,
                'image' => $imageName,
                'phone' => $request->product_telefon,
                'slug' => Str::slug($request->title, '-'),
                'categories_id' => $request->categories,
                'sub_categories_id' => (!empty($request->sub_categories) ? null : $request->sub_categories),
                'stock' => $request->product_stock,
                'price' => $request->product_price,
                'description' => $request->product_body,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            if(!empty($request->sub_categories)) {
                DB::table('product_sub_categories')->insert(
                    ['product_id' => $pID, 'sub_categories_id' => $request->sub_categories]
                );
            }

            return redirect()->route('admin.product.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('adm.product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = \App\Categories::with('sub_categories')->get();
        $product = Product::with(['categories', 'subCategories'])->where('id', $id)->first();
        
        return view('adm.product.edit', compact('cat', 'product'));
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
        $product = Product::find($id);

        $product->subCategories()->detach($id);
        
        if($product->image != null) {
            Storage::disk('public')->delete('images/items/' . $product->image);
        }

        if(count(json_decode($product->gallery, true)) != 0) {
            foreach(json_decode($product->gallery, true) as $key => $value) {
                $data[] = "images/items/" . $value;
            }
            
            Storage::disk('public')->delete([implode(',', $data)]);
        }

        $product->delete();
        return "Succesfully";
    }
}
