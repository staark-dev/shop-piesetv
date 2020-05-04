<?php

namespace App\Listeners;

use App\Events\UpdatePoductsOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Order;
use App\Product;
use DB;

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
        if(count($event->product_id) > 1)
        {
            foreach($event->product_id as $pid)
            {
                Product::findOrFail($pid)->increment('orders');

                if(Product::findOrFail($pid)->stock > 0)
                {
                    Product::findOrFail($pid)->decrement('stock');
                }
            }
        } else {
            Product::findOrFail($event->product_id[0])->increment('orders');

            if(Product::findOrFail($event->product_id[0])->stock > 0)
            {
                Product::findOrFail($event->product_id[0])->decrement('stock');
            }
        }

        // Update orders products on db
        if(count(json_decode($event->args['billing_products'], true)) > 1)
        {
            $items = json_decode($event->args['billing_products'], true);

            foreach($items as $key => $value)
            {
                foreach($value as $kr => $it)
                {
                    $kr = str_replace('produs_', '', $kr);
                    DB::insert('insert into orders_products (product_id, order_id) values (?, ?)', [$kr, $event->order->id]);
                }
                
            }
        } else {
            $items = json_decode($event->args['billing_products'], true);

            foreach($items as $tr)
            {
                $tr = str_replace('produs_', '', array_keys($tr));
                DB::insert('insert into orders_products (product_id, order_id) values (?, ?)', [$tr[0], $event->order->id]);
            }
        }
    }
}
