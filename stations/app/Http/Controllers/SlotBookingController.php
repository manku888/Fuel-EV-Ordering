<?php

namespace App\Http\Controllers;
use App\Models\EvStation;
use App\Models\Car;
use App\Models\Slot;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlotBookingController extends Controller
{
    public function book($stationId)
    {
        $cars = Car::all();
        $station = EvStation::find($stationId);


        if (!$station) {
            return back()->withErrors(['station' => 'Station not found']);
        }

         // Fetch all bookings or pending slots in the station for user see
        $bookings = Booking::with(['car', 'slot.station'])
        ->whereHas('slot', function ($query) use ($stationId) {
        $query->where('station_id', $stationId);
       })->paginate(6)->appends(request()->query());

        return view('slot.booking', compact('stationId', 'cars', 'station','bookings'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'car_no' => 'required|string',
            'car_id' => 'required|exists:cars,id',
            'units' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // Create or update the car with car_no
            $car = Car::find($validated['car_id']);
            $car->car_no = $validated['car_no'];
            $car->save();

            // Create a slot
            $slot = Slot::create([
                'station_id' => $request->station_id,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'status' => 'booked',
            ]);

            // Create a booking
            $totalPrice = $car->unit_price * $validated['units'];
            Booking::create([
                'slot_id' => $slot->id,
                'car_id' => $car->id,
                'car_no' => $validated['car_no'],
                'units' => $validated['units'],
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);
        });

        return redirect()->route('booking.details')->with('success', 'Booking successfully created.');
    }


    public function bookingDetails()
    {
        $bookings = Booking::with(['car', 'slot'])->latest()->paginate(12)->appends(request()->query());
        return view('slot.details', compact('bookings'));

    }


}
