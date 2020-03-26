<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(Product::class, function (Faker $faker) {
    $title = Str::random(25);
    $array = [1, 2, 3, 4];
    return [
        'title' => $title,
        'image' => Storage::disk('public')->url('images/items/'. Arr::random($array) .'.jpg'),
        'slug' => Str::slug($title, '-'),
        'category' => '1',
        'stock' => '5',
        'price' => Arr::random([59, 130, 230, 173, 756, 132, 29, 76, 98, 499, 354, 231]) . '.00',
        'description' => Str::random(100),
    ];
});
