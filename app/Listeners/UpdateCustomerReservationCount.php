<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCustomerReservationCount
{
    public function handle(ReservationCreated $event)
    {
        $customer = $event->reservation->customer;
        if ($customer) {
            $customer->reservation_count = $customer->reservations()->count();
            $customer->save();
        }
    }
}
