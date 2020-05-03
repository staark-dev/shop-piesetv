<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Cart;
use Auth;
use Cache;
use App\Http\Controllers\HomeController as HomeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['*'], function ($view) {
            $data = 0;
            if(Auth::check()) {
                $cart = Cart::where('user_id', '=', Auth::user()->id)->get();
                
                if($cart->count() > 0) $data = count(json_decode($cart[0]->product_info, true));
            } else {
                $ip = \request()->ip();
                $cart = Cart::where('user', '=', $ip)->get();
                if($cart->count() > 0) $data = count(json_decode($cart[0]->product_info, true));
            }

            $view->with('check_cart', $data);
        });

        Schema::defaultStringLength(191);
    }
}
