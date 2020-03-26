<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Categories;
use App\SubCategories;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $products = Product::all();
        $cat = Categories::all();
        $subCat = SubCategories::all();
        $totalCat = $cat->count() + $subCat->count();

        $recentProduct = Product::with(['categories', 'subCategories'])->orderBy('created_at', 'desc')->take(5)->get();
        //dd($recentProduct);
        return view('adm.index', compact('users', 'products', 'totalCat', 'recentProduct'));
    }
}
