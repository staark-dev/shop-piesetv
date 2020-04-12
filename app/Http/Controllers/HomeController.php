<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Carbon\Carbon;
use App\Cart;
use Spatie\Sitemap\SitemapGenerator;
use Auth;
use Cache;
use App\Events\UpdateProductStock;
use App\Events\OrderCreated;

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = Categories::count();
        $headCat = Categories::take(3)->get();
        $allCat = Categories::skip(3)->take($count - 3)->get();
        $products = Product::inRandomOrder()->limit(8)->get();

        if(Auth::check()) {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();
            Cache::forget('cart_items');
            if($cart->count() > 0)  Cache::add('cart_items', count(json_decode($cart[0]->product_info, true) ));
        } else {
            $ip = getRealIpAddr();
            $cart = Cart::where('user', '=', $ip)->get();
            Cache::forget('cart_items');
            if($cart->count() > 0) Cache::add('cart_items', count(json_decode($cart[0]->product_info, true)));
        }

        //event(new OrderCreated(1, Auth::user()->id));
        //event(new UpdateProductStock(1, 1));

        return view('home', compact('products', 'headCat', 'allCat'));
    }

    public function livrare() {
        $count = Categories::count();
        $headCat = Categories::take(3)->get();
        $allCat = Categories::skip(3)->take($count - 3)->get();
        return view('livrare', compact('headCat', 'allCat'));
    }
}
