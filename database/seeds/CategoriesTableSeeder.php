<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Componente PC
        DB::table('categories')->insert([
            'name' => 'Componente PC',
            'slug' => Str::slug('Componente PC', '-'),
        ]);

        // Componente TV
        DB::table('categories')->insert([
            'name' => 'Componente TV',
            'slug' => Str::slug('Componente TV', '-'),
        ]);

        // Electronică
        DB::table('categories')->insert([
            'name' => 'Electronică',
            'slug' => Str::slug('Electronică', '-'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Componente Laptop',
            'slug' => Str::slug('Componente Laptop', '-'),
        ]);

        DB::table('categories')->insert([
            'name' => 'Cipuri BGA',
            'slug' => Str::slug('Cipuri BGA', '-'),
        ]);
    }
}
