<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\UserHistory;

class LoginSuccess
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
     * @param  object  $event
     * @return void
     */
    public function handle(Login $login)
    {
        $logs = new UserHistory;
        $logs->login($login->user->name, $login->user->id);
        \Session::flash('message', 'Hi ' . $login->user->name . ', nice to see you again');
    }
}
