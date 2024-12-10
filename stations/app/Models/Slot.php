<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'start_time',
        'end_time',
        'status',
    ];

    // Relationship with EV Station
    public function station()
    {
        return $this->belongsTo(EvStation::class);  // Assuming you have a Station model
    }

    // Relationship with Booking
    public function booking()
    {
        return $this->hasOne(Booking::class); // A slot can have one booking
    }
}
