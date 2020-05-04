<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    public $timestamps = false;

    public function product()
    {
        return $this->hasMany('App\Product', 'categories_id');
    }

    public function sub_categories()
    {
        return $this->belongsToMany('App\SubCategories');
    }
}
