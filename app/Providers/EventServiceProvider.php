<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\ReservationCreated' => [
            'App\Listeners\UpdateCustomerReservationsCount',
        ],
        'App\Events\ReservationDeleted' => [
            'App\Listeners\UpdateCustomerReservationsCount',
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
