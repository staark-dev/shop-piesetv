<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\User;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $order, $products, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, $products = [])
    {
        $this->user = $user;
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('salles@shop-piesetv.ro')
                ->markdown('emails.orders.shipped');
    }
}
