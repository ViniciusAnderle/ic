<?php

namespace App\Visitors;

use App\Models\Customer;

class CountReservationsVisitor implements ReservationsVisitor
{
    public function visitCustomer(Customer $customer)
    {
        return $customer->reservations()->count();
    }
}
