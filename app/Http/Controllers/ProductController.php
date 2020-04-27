<?php

namespace App\Http\Controllers;

use App\Events\UserViewProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use Auth;
use App\UserHistory;

class ProductController extends Controller
{
    public function index($slug)
    {
        $product = Product::with('categories')->where('slug', '=', $slug)->get()[0];
        $categories = $product->categories;
        if(Auth::check()) {
            $history = UserHistory::where('user_id', '=', Auth::user()->id)->where('type', '=', 2)->orderBy('id')->take(4)->get();
        }

        // Events
        $products = Product::findOrFail($product->id);
        if(Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
        } else $user = Auth::guest();

        event(new UserViewProduct($products));

        if(isset($history)) {
            return view('product', compact('product', 'categories', 'history'));
        } else {
            return view('product', compact('product', 'categories'));
        }
    }
}
