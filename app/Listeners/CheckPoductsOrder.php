<?php

namespace App\Listeners;

use App\Events\UpdatePoductsOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckPoductsOrder
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
     * @param  UpdatePoductsOrder  $event
     * @return void
     */
    public function handle(UpdatePoductsOrder $event)
    {
        //
    }
}
