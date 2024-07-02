<?php

namespace App\Visitors;

use App\Models\Customer;

interface ReservationsVisitor
{
    public function visitCustomer(Customer $customer);
}
