<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Mediators\ReservationMediatorInterface;
use App\Models\SystemLog; // Importe o model de log aqui
use Illuminate\Support\Facades\Auth;

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

        $room = new Room();
        $room->hotel_id = $request->hotel_id;
        $room->room_number = $request->room_number;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->save();

        // Log de criação de quarto
        SystemLog::create([
            'action' => 'create_room',
            'user_id' => Auth::id(),
            'description' => 'Usuário criou o quarto: ' . $room->room_number,
        ]);

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

        $oldData = $room->toArray(); // Capture os dados antigos antes de atualizar

        $room->hotel_id = $request->hotel_id;
        $room->room_number = $request->room_number;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->save();

        // Log de atualização de quarto
        $newData = $room->toArray(); // Capture os novos dados após atualizar
        $this->logChanges($room, $oldData, $newData);

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully');
    }

    protected function logChanges($room, $oldData, $newData)
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

        // Remove 'updated_at' from changes if present
        unset($changes['updated_at']);
        // Remove 'created_at' from changes if present
        unset($changes['created_at']);

        if (count($changes) > 0) {
            $user = Auth::user();
            $changesString = '';
            foreach ($changes as $field => $change) {
                $changesString .= "$field: '{$change['old']}' -> '{$change['new']}'\n";
            }
            $logMessage = 'Room (' . $room->id . ') updated by ' . $user->name . '. Changes: ' . $changesString;


            SystemLog::create([
                'action' => 'update_room',
                'user_id' => $user->id,
                'description' => $logMessage,
            ]);
        }
    }

    public function destroy(Room $room)
    {
        // Log de exclusão de quarto antes de deletar
        $user = Auth::user();
        SystemLog::create([
            'action' => 'delete_room',
            'user_id' => $user->id,
            'description' => 'Usuário excluiu o quarto: ' . $room->room_number,
        ]);

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully');
    }
}
