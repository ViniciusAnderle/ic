<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mediators\ReservationMediatorInterface;
use App\Models\SystemLog; // Importe o model de log aqui
use Illuminate\Support\Facades\Auth;

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

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();

        // Log de criação de cliente
        SystemLog::create([
            'action' => 'create_customer',
            'user_id' => Auth::id(),
            'description' => 'User created customer: ' . $customer->name,
        ]);

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

        $oldData = $customer->toArray();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();

        // Log de atualização de cliente
        $this->logChanges($customer, $oldData, $customer->toArray());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    protected function logChanges($customer, $oldData, $newData)
    {
        $changes = [];

        foreach ($newData as $key => $value) {
            if ($oldData[$key] !== $value) {
                $changes[$key] = [
                    'old' => $oldData[$key],
                    'new' => $value,
                ];
            }
        }

        // Remove campos que não devem ser registrados no log, se necessário
        unset($changes['updated_at']);
        unset($changes['created_at']);

        if (count($changes) > 0) {
            $user = Auth::user();
            $changesString = '';
            foreach ($changes as $field => $change) {
                $changesString .= "$field: '{$change['old']}' -> '{$change['new']}'\n";
            }
            $logMessage = 'Customer (' . $customer->id . ') updated by ' . $user->name . '. Changes: ' . $changesString;
            SystemLog::create([
                'action' => 'update_customer',
                'user_id' => $user->id,
                'description' => $logMessage,
            ]);
        }
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        // Log de exclusão de cliente
        SystemLog::create([
            'action' => 'delete_customer',
            'user_id' => Auth::id(),
            'description' => 'User deleted customer: ' . $customer->name,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}
