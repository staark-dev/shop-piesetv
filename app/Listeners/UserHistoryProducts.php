<?php

namespace App\Listeners;

use App\Events\UserViewProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\UserHistory;

class UserHistoryProducts
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
     * @param  UserViewProduct  $event
     * @return void
     */
    public function handle(UserViewProduct $event)
    {
        $log = new UserHistory;
        $log->viewProduct($event->product);
    }
}
