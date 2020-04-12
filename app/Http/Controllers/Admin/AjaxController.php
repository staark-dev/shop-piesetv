<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Online;
use App\User;
use App\Product;
use Auth;
use DB;

class AjaxController extends Controller
{
    public function online(){
        $guest = Online::scopeGuests()->get();
        $users = Online::scopeRegistered()->get();

        $total = array('guest' => $guest, 'users' => $users);

        return $total;
    }

    public function products(){

    }

    public function orders(){

    }
}
