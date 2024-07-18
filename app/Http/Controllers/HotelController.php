<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

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

        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->save();

        // Log de atualização de hotel
        SystemLog::create([
            'action' => 'update_hotel',
            'user_id' => Auth::id(),
            'description' => 'Usuário atualizou o hotel: ' . $hotel->name,
        ]);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel atualizado com sucesso.');
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
