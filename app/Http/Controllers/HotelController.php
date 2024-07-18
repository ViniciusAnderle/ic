<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Visitors\SystemLogVisitor;

class HotelController extends Controller
{
    protected $logger;

    public function __construct(SystemLogVisitor $logger)
    {
        $this->logger = $logger;
    }

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

        // Registrar ação de criação de hotel
        $this->logger->logAction('create_hotel', 'Created hotel: ' . $request->name);

        // Lógica para armazenar o hotel
        $hotel = Hotel::create($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel created successfully.');
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

        // Registrar ação de atualização de hotel
        $this->logger->logAction('update_hotel', 'Updated hotel: ' . $hotel->name);

        // Lógica para atualizar o hotel
        $hotel->update($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    public function destroy(Hotel $hotel)
    {
        // Registrar ação de exclusão de hotel
        $this->logger->logAction('delete_hotel', 'Deleted hotel: ' . $hotel->name);

        // Lógica para excluir o hotel
        $hotel->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully');
    }
}
