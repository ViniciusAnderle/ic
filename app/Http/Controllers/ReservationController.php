<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Customer;
use App\Events\ReservationCreated;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

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
        $statuses = ['pendente', 'confirmada', 'cancelada', 'finalizada'];

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

            // Registrar log de criação
            $user = Auth::user();
            $logMessage = 'Created reservation: ' . $reservation->id . ' by ' . $user->name;
            SystemLog::create([
                'action' => 'create_reservation',
                'user_id' => $user->id,
                'description' => $logMessage,
            ]);

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
        $statuses = ['pendente', 'confirmada', 'cancelada', 'finalizada'];

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

        // Captura os dados da reserva antes da atualização
        $oldData = $reservation->getAttributes();

        // Atualiza os dados da reserva
        $reservation->hotel_id = $request->hotel_id;
        $reservation->room_id = $request->room_id;
        $reservation->customer_id = $request->customer_id;
        $reservation->checkin_date = $request->checkin_date;
        $reservation->checkout_date = $request->checkout_date;
        $reservation->status = $request->status;
        $reservation->save();

        // Captura os dados da reserva após a atualização
        $newData = $reservation->getAttributes();

        // Log de atualização de reserva com as mudanças feitas
        $this->logChanges($reservation, $oldData, $newData);

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva atualizada com sucesso.');
    }

    /**
     * Log changes made to a reservation.
     *
     * @param  Reservation  $reservation
     * @param  array  $oldData
     * @param  array  $newData
     * @return void
     */
    protected function logChanges($reservation, $oldData, $newData)
    {
        $changes = [];

        foreach ($newData as $key => $value) {
            if ($oldData[$key] != $value) { // Use != to compare values irrespective of types
                $changes[$key] = [
                    'old' => $oldData[$key],
                    'new' => $value,
                ];
            }
        }

        // Remove campos de timestamps das mudanças, se presentes
        unset($changes['updated_at']);
        unset($changes['created_at']);

        if (count($changes) > 0) {
            $user = Auth::user();
            $changesString = '';
            foreach ($changes as $field => $change) {
                $changesString .= "$field: '{$change['old']}' -> '{$change['new']}'\n";
            }
            $logMessage = 'Reservation (' . $reservation->id . ') updated by ' . $user->name . '. Changes: ' . $changesString;
            SystemLog::create([
                'action' => 'update_reservation',
                'user_id' => $user->id,
                'description' => $logMessage,
            ]);
        }
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        // Registrar log de exclusão
        $user = Auth::user();
        $logMessage = 'Deleted reservation: ' . $reservation->id . ' by ' . $user->name;
        SystemLog::create([
            'action' => 'delete_reservation',
            'user_id' => $user->id,
            'description' => $logMessage,
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully.');
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
