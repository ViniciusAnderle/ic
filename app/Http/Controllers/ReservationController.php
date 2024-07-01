<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Customer;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $hotels = Hotel::all(); // Recupere todos os hotéis do banco de dados
        $rooms = Room::all();   // Recupere todos os quartos do banco de dados
        $customers = Customer::all(); // Recupere todos os clientes do banco de dados
        $statuses = ['pending', 'confirmed', 'cancelled']; // Lista de status predefinidos
        
        return view('reservations.create', compact('hotels', 'rooms', 'customers', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required',
            'room_id' => 'required',
            'customer_id' => 'required',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'status' => 'nullable',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $hotels = Hotel::all();
        $rooms = Room::where('hotel_id', $reservation->hotel_id)->get();
        $customers = Customer::all();
        $statuses = ['pending', 'confirmed', 'cancelled'];
    
        return view('reservations.edit', compact('reservation', 'hotels', 'rooms', 'customers', 'statuses'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'hotel_id' => 'required',
            'room_id' => 'required',
            'customer_id' => 'required',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'status' => 'nullable',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }
    // ReservationController.php

    public function getRoomsByHotel($hotel_id)
    {
        $rooms = Room::where('hotel_id', $hotel_id)->get();
        return response()->json($rooms);
    }
}
