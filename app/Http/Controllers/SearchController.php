<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = "";
        if($request->query != null) {
            $get = $request->input('query');

            $stmp = Product::with('categories')->where('title', 'LIKE', '%'. $get .'%')->get();
            if(count($stmp))
            {
                $search = $stmp;
            }
        } else {
            $search = "Va rugam sa introduceti cu atentie produsul(e) care vreti sa fie afisate.";
        }
        
        return view('search', compact('search'));
    }

    public function searchAdvance()
    {

    }
}
