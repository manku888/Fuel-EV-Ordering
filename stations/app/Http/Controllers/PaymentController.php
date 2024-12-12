<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    // Show payment page
    public function showPayment($bookingId)
    {
        $booking = Booking::with(['car', 'slot'])->findOrFail($bookingId);

        if ($booking->status === 'booked') {
            return redirect()->route('booking.details')->with('error', 'This booking is already paid.');
        }

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        // Razorpay order create karein
        $orderData = [
            'receipt'         => 'rcptid_' . $booking->id,
            'amount'          => $booking->total_price * 100, // Amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto-capture payment
        ];

        $razorpayOrder = $api->order->create($orderData);

        return view('slot.payment', [
            'booking' => $booking,
            'razorpayOrderId' => $razorpayOrder->id,
            'razorpayKey' => env('RAZORPAY_KEY_ID'),
            'amount' => $booking->total_price,
            'currency' => 'INR',
        ]);
    }

    // Handle payment confirmation
    public function confirmPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->status === 'booked') {
            return redirect()->route('booking.details')->with('error', 'This booking is already paid.');
        }

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            if ($payment->status === 'captured') {
                $booking->status = 'booked';
                $booking->save();

                return redirect()->route('booking.details')->with('success', 'Payment successfully completed.');
            }
        } catch (\Exception $e) {
            return redirect()->route('slot.payment', $booking->id)->with('error', 'Payment failed, please try again.');
        }
    }
}
