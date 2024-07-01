<?php

namespace App\Mediators;

interface ReservationMediatorInterface
{
    public function createHotel(array $data);
    public function updateHotel($hotel, array $data);
    public function deleteHotel($hotel);

    public function createRoom(array $data);
    public function updateRoom($room, array $data);
    public function deleteRoom($room);

    public function createCustomer(array $data);
    public function updateCustomer($customer, array $data);
    public function deleteCustomer($customer);

    public function createReservation(array $data);
    public function updateReservation($reservation, array $data);
    public function deleteReservation($reservation);
}
