<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }


    public function create()
    {
        $hotels = Hotel::all(); // Recupere todos os hotéis do banco de dados
    
        return view('rooms.create', compact('hotels'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id', // Garante que o hotel_id existe na tabela de hotéis
            'room_number' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);
    
        Room::create($request->all());
    
        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }
    
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id' => 'required',
            'room_number' => 'required',
            'type' => 'nullable',
            'price' => 'nullable',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }
}
