<?php

namespace App\States;

use App\Models\Reservation;

class CancelledState implements ReservationState
{
    public function confirm(Reservation $reservation)
    {
        // Não pode confirmar, já está cancelado
    }

    public function cancel(Reservation $reservation)
    {
        // Não faz nada, já está cancelado
    }
}

