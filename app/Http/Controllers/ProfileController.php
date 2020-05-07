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
        $user = User::with('orders')->where('id', '=', Auth::user()->id)->first();
        return view('users.profile', compact('user'));
    }

    public function order()
    {
        $user = User::with('orders')->where('id', '=', Auth::user()->id)->first();
        $orders = $user->orders()->orderBy('id', 'desc')->paginate(5);
        return view('users.orders', compact('user', 'orders'));
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
