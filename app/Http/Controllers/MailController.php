<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\OrderShipped;

class MailController extends Controller
{
    public function index()
    {
        $order = \App\Order::findOrFail(1);
        Mail::to('ionuzcostin@gmail.com')->send(new OrderShipped($order));
    }
}
