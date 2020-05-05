<?php

namespace App\Mail;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComandaNoua extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $user, $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user, $products = [])
    {
        $this->order = $order;
        $this->user = $user;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('salles@shop-piesetv.ro')->markdown('emails.orders.admin');
    }
}
