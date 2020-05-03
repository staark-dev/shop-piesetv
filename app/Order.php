<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'product_id', 'confirmed', 'status', 'hash', 'placed_date', 'last_update_date', 'address_id'
    ];

    
}
