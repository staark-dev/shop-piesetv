<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $cat = Categories::with(['product', 'sub_categories'])->where('slug', '=', $slug)->first();
        //dd($cat->sub_categories);
        return view('categories', compact('cat'));
    }

    public function sub($catid, $slug)
    {
        $cat = \App\SubCategories::with(['product', 'categories'])->where('slug', '=', $slug)->first();
        return view('cat_show', compact('cat'));
    }
}
