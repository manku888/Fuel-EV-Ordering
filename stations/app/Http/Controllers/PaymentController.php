<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show payment page
    public function showPayment($bookingId)
    {
        $booking = Booking::with(['car', 'slot'])->findOrFail($bookingId);

        if ($booking->status === 'booked') {
            return redirect()->route('booking.details')->with('error', 'This booking is already paid.');
        }

        return view('slot.payment', compact('booking'));
    }

    // Handle payment confirmation
    public function confirmPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->status === 'booked') {
            return redirect()->route('booking.details')->with('error', 'This booking is already paid.');
        }

        // Dummy payment processing
        $booking->status = 'booked';
        $booking->save();

        return redirect()->route('booking.details')->with('success', 'Payment successfully completed.');
    }
}

