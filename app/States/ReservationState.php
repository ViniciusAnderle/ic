<?php

namespace App\States;

use App\Models\Reservation;

interface ReservationState
{
    public function confirm(Reservation $reservation);
    public function cancel(Reservation $reservation);
}

