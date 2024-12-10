<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvStation extends Model
{
    use HasFactory;
    protected $table = 'ev_stations';
    // Define fillable columns or guarded
    protected $fillable = ['name', 'address', 'latitude', 'longitude'];


    public function slots()
{
    return $this->hasMany(Slot::class);  // A station has many slots
}

public function bookings()
{
    return $this->hasMany(Booking::class);  // A station has many bookings
}

}

