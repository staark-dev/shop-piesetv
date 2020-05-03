<?php

namespace App\Listeners;

use App\Events\UserAddtoCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Auth;
use Carbon\Carbon;
use App\UserHistory;


class UserCartUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserAddtoCart  $event
     * @return void
     */
    public function handle(UserAddtoCart $event)
    {
        $now = Carbon::now();
        $ip = \request()->ip();

        if(Auth::check()) {
            // Create and insert log to database
            $log = new UserHistory();
            $log->log = Auth::user()->name ." a adaugat in cos produsul ". $event->product->title .". [". $now ."] [IP: ". $ip ."]";
            $log->type = 3;
            $log->user_id = Auth::user()->id;
            $log->product_id = $event->product->id;
            $log->save();
        } else {
            // Create and insert log to database
            $log = new UserHistory();
            $log->log = "Vizitator a adaugat in cos produsul ". $event->product->title .". [". $now ."] [IP: ". $ip ."]";
            $log->type = 3;
            $log->product_id = $event->product->id;
            $log->save();
        }
    }
}
