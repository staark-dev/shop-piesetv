<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Order;

class UpdatePoductsOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $product_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product_id, Order $order, $args = [])
    {
        $this->product_id   = $product_id;
        $this->order        = $order;
        $this->args         = $args;
    }
}
