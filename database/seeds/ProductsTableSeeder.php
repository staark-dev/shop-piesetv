<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'Just another product name',
            'image' => Storage::disk('public')->url('images/items/1.jpg'),
            'slug' => Str::slug('Just another product name', '-'),
            'categories_id' => '1',
            'stock' => '5',
            'price' => '179.00',
            'description' => '',
        ]);

        DB::table('products')->insert([
            'title' => 'Some item name here',
            'image' => Storage::disk('public')->url('images/items/2.jpg'),
            'slug' => Str::slug('Some item name here', '-'),
            'categories_id' => '1',
            'stock' => '5',
            'price' => '280.00',
            'description' => '',
        ]);

        DB::table('products')->insert([
            'title' => 'Great product name here',
            'image' => Storage::disk('public')->url('images/items/3.jpg'),
            'slug' => Str::slug('Great product name here', '-'),
            'categories_id' => '1',
            'stock' => '5',
            'price' => '56.00',
            'description' => '',
        ]);

        DB::table('products')->insert([
            'title' => 'Just another product listed',
            'image' => Storage::disk('public')->url('images/items/4.jpg'),
            'slug' => Str::slug('Just another product listed', '-'),
            'categories_id' => '1',
            'stock' => '5',
            'price' => '179.00',
            'description' => ' lorem ',
        ]);
    }
}
