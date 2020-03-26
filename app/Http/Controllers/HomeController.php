<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Carbon\Carbon;
use Spatie\Sitemap\SitemapGenerator;

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
        // SitemapGenerator::create('https://upgrade.shop-piesetv.ro')->writeToFile(public_path('sitemap.xml'));
        // SitemapGenerator::create('https://upgrade.shop-piesetv.ro')->getSitemap()->writeToDisk('public', 'sitemap.xml'); 

        $count = Categories::count();
        $headCat = Categories::take(3)->get();
        $allCat = Categories::skip(3)->take($count - 3)->get();
        $products = Product::inRandomOrder()->limit(8)->get();
        return view('home', compact('products', 'headCat', 'allCat'));
    }

    public function livrare() {
        $count = Categories::count();
        $headCat = Categories::take(3)->get();
        $allCat = Categories::skip(3)->take($count - 3)->get();
        return view('livrare', compact('headCat', 'allCat'));
    }
}
