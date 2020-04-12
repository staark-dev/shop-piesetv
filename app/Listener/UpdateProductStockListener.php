<?php

namespace App\Listener;

use App\Events\UpdateProductStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductStockListener
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
     * @param  UpdateProductStock  $event
     * @return void
     */
    public function handle(UpdateProductStock $event)
    {
        //
    }
}
