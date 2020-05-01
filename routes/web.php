<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@index');
Route::get('/rules-and-terms', 'HomeController@index');
Route::get('/about', 'HomeController@index');
Route::get('/faq', 'HomeController@livrare')->name('faq');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('fb.login');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback')->name('fb.login.back');

Route::get('/search', function () {
    return view('search');
})->name('advance.search');

Route::get('/search', 'SearchController@search')->name('search');

Route::group(['as'=> 'cart.', 'prefix' => 'cart', 'middleware' => ['web']], function () {
    Route::get('/', 'AddCartController@index')->name('index');
    Route::get('/add/{product}', 'AddCartController@store')->name('store');
    Route::post('/add/{product}', 'AddCartController@store')->name('store');
    Route::put('/update/{id}', 'AddCartController@update')->name('update');
    Route::delete('/remove/{id}', 'AddCartController@destroy')->name('delete');
    Route::get('/procced', 'AddCartController@placeOrder')->name('order.place');
    Route::post('/procced/complete', 'AddCartController@orderComplete')->name('order.complete');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/user/myaccount', function () {
        return view('users.index');
    })->name('user.profile');
});

Route::get('/cat/{slug}', 'CategoriesController@index')->name('cat.view');
route::get('/cat/{catid}/{slug}', 'CategoriesController@sub')->name('cat.sub');
Route::get('/product/{slug}', 'ProductController@index')->name('product.view');

Route::group(['as'=> 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('user', 'UsersController');
    Route::resource('product', 'ProductController');
    Route::resource('cat', 'CategoriesController');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('/activate/{user}', 'UsersController@activate')->name('activate');
    });

    Route::group(['prefix' => 'cat', 'as' => 'cat.'], function () {
        Route::get('/sub/create', 'CategoriesController@sub_create')->name('sub.create');
        Route::post('/sub/store', 'CategoriesController@sub_store')->name('sub.store');
        Route::delete('/sub/{cat}', 'CategoriesController@sub_destroy')->name('sub.destroy');
        Route::put('/sub/{cat}', 'CategoriesController@sub_update')->name('sub.update');
    });
    
    Route::resource('setting', 'SettingsController')->only([
        'index', 'show', 'update'
    ]);

    Route::resource('cart', 'CartController')->only([
        'index', 'show', 'update'
    ]);

    Route::resource('task', 'TasksController')->only([
        'index', 'show'
    ]);
    
    Route::resource('orders', 'OrdersController')->only([
        'index', 'update'
    ]);

    Route::resource('mail', 'MailController')->only([
        'index', 'update'
    ]);

    Route::resource('role', 'RoleController')->only([
        'create', 'store', 'index'
    ]);
});