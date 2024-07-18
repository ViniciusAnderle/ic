<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Customer;
use App\Events\ReservationCreated;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        // Obter todas as reservas
        $reservations = Reservation::all();

        // Obter todos os status de reserva únicos
        $reservationStatuses = Reservation::distinct()->pluck('status')->toArray();

        // Filtrar reservas se o filtro por status estiver definido
        if ($request->has('reservation_status') && $request->input('reservation_status') !== 'all') {
            $reservationStatus = $request->input('reservation_status');
            $reservations = Reservation::where('status', $reservationStatus)->get();
        }

        return view('reservations.index', compact('reservations', 'reservationStatuses'));
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

        // Criação da reserva
        $reservation = Reservation::create($request->all());

        // Verifica se a reserva foi criada com sucesso
        if ($reservation) {
            // Dispara o evento de reserva criada
            event(new ReservationCreated($reservation));

            return redirect()->route('reservations.index')
                ->with('success', 'Reservation created successfully.');
        }

        // Lógica de tratamento de erro, se necessário
        return redirect()->back()
            ->with('error', 'Failed to create reservation.');
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

    public function getRoomsByHotel($hotel_id)
    {
        $rooms = Room::where('hotel_id', $hotel_id)->get();
        return response()->json($rooms);
    }
    public function confirm(Reservation $reservation)
    {
        $reservation->confirm();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation confirmed successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->cancel();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully.');
    }
}
