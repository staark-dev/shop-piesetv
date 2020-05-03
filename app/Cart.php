<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "add_cos";

    protected $fillable = [
        'user_id', 'user', 'product_info'
    ];

    

    public $timestamps = true;
}
