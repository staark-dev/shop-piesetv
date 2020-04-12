<?php

namespace App\Listeners;

use App\Events\UpdateProductStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Product;
use Carbon\Carbon;

class UpdateProductStockListener
{
    public function handle(UpdateProductStock $event)
    {
        $prod = Product::find($event->productID);
        
        if($prod->stock >= 2) {
            $prod->stock = $prod->stock - 1;
            $prod->updated_at = Carbon::now();
        } else {
            $prod->stock = 0;
            $prod->updated_at = Carbon::now();
        }

        $prod->save();
    }
}
