<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table = 'sub_categories';

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'categories_sub_categories');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product');
    }
}
