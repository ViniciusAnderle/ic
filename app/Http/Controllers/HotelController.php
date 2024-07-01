<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Mediators\ReservationMediatorInterface;

class HotelController extends Controller
{
    protected $mediator;

    public function __construct(ReservationMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
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

        $this->mediator->createHotel($request->all());

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

        $this->mediator->updateHotel($hotel, $request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    public function destroy(Hotel $hotel)
    {
        $this->mediator->deleteHotel($hotel);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully');
    }
}
