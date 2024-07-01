<?php
// ReservationController.php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Customer;
use App\Mediators\ReservationMediatorInterface;

class ReservationController extends Controller
{
    protected $mediator;

    public function __construct(ReservationMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }

    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        $rooms = Room::all();
        $customers = Customer::all();
        $statuses = ['pending', 'confirmed', 'cancelled'];

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

        $this->mediator->createReservation($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
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

        $this->mediator->updateReservation($reservation, $request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $this->mediator->deleteReservation($reservation);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }

    public function getRoomsByHotel($hotel_id)
    {
        $rooms = Room::where('hotel_id', $hotel_id)->get();
        return response()->json($rooms);
    }
}
