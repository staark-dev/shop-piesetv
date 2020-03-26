<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index($slug)
    {
        $product = Product::with('categories')->where('slug', '=', $slug)->first();
        return view('product', compact('product'));
    }
}
