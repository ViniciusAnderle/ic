<?php
// RoomController.php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Mediators\ReservationMediatorInterface;

class RoomController extends Controller
{
    protected $mediator;

    public function __construct(ReservationMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }

    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_number' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);

        $this->mediator->createRoom($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        return view('rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id' => 'required',
            'room_number' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);

        $this->mediator->updateRoom($room, $request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        $this->mediator->deleteRoom($room);

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }
}
