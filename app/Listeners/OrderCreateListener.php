<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class OrderCreateListener
{
    public function handle(OrderCreate $event)
    {
        DB::table('orders')->insert([
            'hash' => Str::random(64),
            'user' => $event->userID,
            'product' => $event->productID,
            'created_at' => Carbon::now()
        ]);
    }
}
