<?php

namespace App\States;

use App\Models\Reservation;

class ConfirmedState implements ReservationState
{
    public function confirm(Reservation $reservation)
    {
        // Não faz nada, já está confirmado
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'cancelled';
        $reservation->save();
        $reservation->setState(new CancelledState());
    }
}

