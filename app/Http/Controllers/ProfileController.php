<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Product;
use App\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('orders')->with('addresses')->where('id', '=', Auth::user()->id)->first();
        return view('users.index', compact('user'));
    }

    public function order()
    {
        
    }
    
    public function wishlist()
    {
        
    }
    
    public function return()
    {
        
    }
    
    public function settings()
    {
        
    }

    public function seller()
    {
        
    }

    public function delivery()
    {
        
    }
}
