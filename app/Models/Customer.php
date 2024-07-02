<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'reservation_count'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
