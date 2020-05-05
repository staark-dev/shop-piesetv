<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'products', 'confirmed', 'status',
        'hash', 'placed_date', 'last_update_date', 
        'address_id', 'total_price', 'tax'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeAwaitDelivery($query, $user_id)
    {
        return $query->where('status', '=', 'true')
            ->where('user_id', '=', $user_id)
            ->get()
            ->count();
    }

    public function scopeDelivery($query, $user_id)
    {
        return $query->where('confirmed', '=', true)
            ->where('user_id', '=', $user_id)
            ->get()
            ->count();
    }
}
