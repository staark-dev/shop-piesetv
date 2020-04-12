<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index($slug)
    {
        $product = Product::with('categories')->where('slug', '=', $slug)->get()[0];
        //dd($product);
        $categories = $product->categories;
        return view('product', compact('product', 'categories'));
    }
}
