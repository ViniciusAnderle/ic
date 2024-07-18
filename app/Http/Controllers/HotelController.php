<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Event\Telemetry\System;
use Carbon\Carbon;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'description' => 'nullable',
        ]);

        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->save();

        // Log de criação de hotel
        SystemLog::create([
            'action' => 'create_hotel',
            'user_id' => Auth::id(),
            'description' => 'Usuário criou o hotel: ' . $hotel->name,
        ]);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel criado com sucesso.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'description' => 'nullable',
        ]);

        // Captura os dados do hotel antes da atualização
        $oldData = $hotel->getAttributes();

        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->save();

        // Captura os dados do hotel após a atualização
        $newData = $hotel->getAttributes();

        // Log de atualização de hotel com as mudanças feitas
        $this->logChanges($hotel, $oldData, $newData);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel atualizado com sucesso.');
    }

    /**
     * Log changes made to a hotel.
     *
     * @param  Hotel  $hotel
     * @param  array  $oldData
     * @param  array  $newData
     * @return void
     */
    protected function logChanges($hotel, $oldData, $newData)
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
        unset($changes['updated_at']); // Remove 'updated_at' from changes if present
        unset($changes['created_at']); // Remove 'created_at' from changes if present
        if (count($changes) > 0) {
            $user = Auth::user();
            $logMessage = 'Hotel (' . $hotel->id . ') atualizado por ' . $user->name . '. Mudanças: ' . json_encode($changes);
            SystemLog::create([
                'action' => 'update_hotel',
                'user_id' => $user->id,
                'description' => $logMessage,
            ]);
        }
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        // Log de exclusão de hotel
        SystemLog::create([
            'action' => 'delete_hotel',
            'user_id' => Auth::id(),
            'description' => 'Usuário excluiu o hotel: ' . $hotel->name,
        ]);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel excluído com sucesso.');
    }
}
