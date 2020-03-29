<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\User;
use App\Product;
use App\Categories;
use App\SubCategories;
use App\Online;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $products = Product::all();
        $cat = Categories::all();
        $subCat = SubCategories::all();
        $totalCat = $cat->count() + $subCat->count();

        $lastActivity = strtotime(Carbon::now()->subMinutes(15));
        $guests = DB::table('sessions')->where('user_id', null)->where('last_activity', '>=', $lastActivity)->count();
        //dd($guests);

        $recentProduct = Product::with(['categories', 'subCategories'])->orderBy('created_at', 'desc')->take(5)->get();
        //dd($recentProduct);
        return view('adm.index', compact('users', 'products', 'totalCat', 'recentProduct'));
    }
}
