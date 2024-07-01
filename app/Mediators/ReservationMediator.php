<?php

namespace App\Mediators;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationMediator implements ReservationMediatorInterface
{
    public function createHotel(array $data)
    {
        DB::transaction(function () use ($data) {
            Hotel::create($data);
        });
    }

    public function updateHotel($hotel, array $data)
    {
        DB::transaction(function () use ($hotel, $data) {
            $hotel->update($data);
        });
    }

    public function deleteHotel($hotel)
    {
        DB::transaction(function () use ($hotel) {
            $hotel->delete();
        });
    }

    public function createRoom(array $data)
    {
        DB::transaction(function () use ($data) {
            Room::create($data);
        });
    }

    public function updateRoom($room, array $data)
    {
        DB::transaction(function () use ($room, $data) {
            $room->update($data);
        });
    }

    public function deleteRoom($room)
    {
        DB::transaction(function () use ($room) {
            $room->delete();
        });
    }

    public function createCustomer(array $data)
    {
        DB::transaction(function () use ($data) {
            Customer::create($data);
        });
    }

    public function updateCustomer($customer, array $data)
    {
        DB::transaction(function () use ($customer, $data) {
            $customer->update($data);
        });
    }

    public function deleteCustomer($customer)
    {
        DB::transaction(function () use ($customer) {
            $customer->delete();
        });
    }

    public function createReservation(array $data)
    {
        DB::transaction(function () use ($data) {
            Reservation::create($data);
        });
    }

    public function updateReservation($reservation, array $data)
    {
        DB::transaction(function () use ($reservation, $data) {
            $reservation->update($data);
        });
    }

    public function deleteReservation($reservation)
    {
        DB::transaction(function () use ($reservation) {
            $reservation->delete();
        });
    }
}
