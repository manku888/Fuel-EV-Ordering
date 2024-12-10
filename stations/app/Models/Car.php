<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['car_no', 'model', 'unit_price'];

    // Define the relationship with Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Optional: You can add relationships if needed, such as linking it to a user or booking.
}

