<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'first_name', 'last_name', 'password', 'sex', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function online()
    {
        return $this->hasMany('App\Online');
    }

    public function scopeGetName($query, $id)
    {
        return $query->where('id', '=', $id)->first()->name;
    }

    public function scopeGetFullName($query)
    {
        $full_name = $query->where('id', '=', \Auth::user()->id)->first()->first_name;
        $full_name .= " " . $query->where('id', '=', \Auth::user()->id)->first()->last_name;

        return $full_name;
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address', 'user_id');
    }

    public function userOrders()
    {
        return Order::where('user_id', \Auth::user()->id)
            ->get()
            ->count();
    }

    public function userOrdersAwait()
    {
        return Order::where([
            'status' => true,
        ])
            ->where('user_id', \Auth::user()->id)
            ->get()
            ->count();
    }

    public function userOrdersDelivery()
    {
        return Order::where([
            'status' => false,
            'confirmed' => true
        ])
            ->where('user_id', \Auth::user()->id)
            ->get()
            ->count();
    }
}
