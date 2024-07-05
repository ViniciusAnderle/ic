<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\States\PendingState;
use App\States\ReservationState;

class Reservation extends Model
{
    protected $fillable = ['hotel_id', 'room_id', 'customer_id', 'checkin_date', 'checkout_date', 'status'];
    private $state;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setState(new PendingState());
    }

    public function setState(ReservationState $state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function confirm()
    {
        $this->state->confirm($this);
    }

    public function cancel()
    {
        $this->state->cancel($this);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

