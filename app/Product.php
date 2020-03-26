<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'image', 'slug', 'category',
        'stock', 'price', 'description',
        'phone', 'sub_categories_id', 'gallery'
    ];

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

    public function subCategories()
    {
        return $this->belongsToMany('App\SubCategories', 'product_sub_categories');
    }
}
