<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action', 'user_id', 'description',
    ];

    /**
     * Get the user associated with the log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
