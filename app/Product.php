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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

    public function subCategories()
    {
        return $this->belongsToMany('App\SubCategories', 'product_sub_categories');
    }

    public function scopeGetName($query, $pID) {
        return $query->where('id', $pID)->get()[0]->title;
    }

    public function scopeGetPrice($query, $pID) {
        return $query->where('id', $pID)->get()[0]->price;
    }

    public function scopeGetData($query, $pID, $expression) {
        return $query->where('id', $pID)->get()[0]->{$expression};
    }
}
