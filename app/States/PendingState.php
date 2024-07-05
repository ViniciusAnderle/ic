<?php

namespace App\States;

use App\Models\Reservation;

class PendingState implements ReservationState
{
    public function confirm(Reservation $reservation)
    {
        $reservation->status = 'confirmed';
        $reservation->save();
        $reservation->setState(new ConfirmedState());
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'cancelled';
        $reservation->save();
        $reservation->setState(new CancelledState());
    }
}

