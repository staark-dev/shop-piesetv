<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'slug' => 'user',
            'created_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'Editor',
            'slug' => 'editor',
            'created_at' => Carbon::now()
        ]);
    }
}
