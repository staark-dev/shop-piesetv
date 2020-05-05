<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UpdateProductStock;
use App\Listener\UpdateProductStockListener;
use App\Events\OrderCreated;
use App\Listener\OrderCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LoginSuccess'
        ],
        
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomeEmail',
        ],

        'App\Events\UserViewProduct' => [
            'App\Listeners\UserHistoryProducts',
        ],

        'App\Events\UserAddtoCart' => [
            'App\Listeners\UserCartUpdate',
        ],

        'App\Events\UpdatePoductsOrder' => [
            'App\Listeners\CheckPoductsOrder',
        ],

        'App\Events\OrderShipped' => [
            'App\Listeners\SendShipmentNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
