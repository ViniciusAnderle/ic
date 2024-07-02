<?php
// CustomerController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mediators\ReservationMediatorInterface;
use App\Visitors\CountReservationsVisitor;

class CustomerController extends Controller
{
    protected $mediator;

    public function __construct(ReservationMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable',
        ]);

        $this->mediator->createCustomer($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable',
        ]);

        $this->mediator->updateCustomer($customer, $request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $this->mediator->deleteCustomer($customer);

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
    public function countReservations(Request $request, Customer $customer)
    {
        $countVisitor = new CountReservationsVisitor();
        $count = $countVisitor->visitCustomer($customer);

        return response()->json(['reservation_count' => $count]);
    }
}
