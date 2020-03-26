<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SSYT',
            'first_name' => 'Costin',
            'last_name' => 'Ionut',
            'sex' => '1',
            'role_id' => '1',
            'email' => 'ionuzcostin@gmail.com',
            'password' => Hash::make('loveme22@@'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Daniel',
            'first_name' => 'Dani',
            'last_name' => 'David',
            'sex' => '1',
            'role_id' => '1',
            'email' => 'info@shop-piesetv.ro',
            'password' => Hash::make('Daniel22@@'),
            'created_at' => Carbon::now()
        ]);
    }
}
