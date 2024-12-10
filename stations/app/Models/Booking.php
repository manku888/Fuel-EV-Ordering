<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['slot_id', 'car_id', 'car_no', 'units', 'total_price', 'status'];

    // Relationship with Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Relationship with Slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
