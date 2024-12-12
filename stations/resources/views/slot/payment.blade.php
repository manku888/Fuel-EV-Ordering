<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-[url('/images/payment3.jpg')] bg-center bg-no-repeat min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-45">
        <h2 class="text-2xl font-bold text-gray-700 text-center">Payment</h2>
        <div class="mt-4">
            <p><strong>Car No:</strong> {{ $booking->car_no }}</p>
            <p><strong>Car Model:</strong> {{ $booking->car->model }}</p>
            <p><strong>Units:</strong> {{ $booking->units }}</p>
            <p><strong>Start Time:</strong> {{ $booking->slot->start_time }}</p>
            <p><strong>End Time:</strong> {{ $booking->slot->end_time }}</p>
            <p><strong>Total Price:</strong> ₹{{ $booking->total_price }}</p>
        </div>
        <form id="payment-form" action="{{ route('payment.confirm', $booking->id) }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <button type="button" onclick="startRazorpayPayment()" class="bg-green-500 text-white px-12 py-2 rounded shadow hover:bg-orange-600">
                Pay with Razorpay
            </button>
        </form>
    </div>

    <!-- Home Button -->
    <div class="absolute top-4 left-4 mt-6 space-x-4">
        <a href="{{ route('home') }}" class="home-button bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-orange-600">
            Home
        </a>
        <a href="http://127.0.0.1:8000/find-ev-stations?_token=WNaIdSbaXnXNtNTg8ySxmZOXKN5IvcyIOFefORLi&latitude=22.729365281124572&longitude=75.89561426287781&station_type=ev" class="home-button bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-orange-600">
            Back
        </a>
    </div>

    <script>
        function startRazorpayPayment() {
            var options = {
                "key": "{{ $razorpayKey }}",
                "amount": "{{ $amount * 100 }}", // Amount in paise
                "currency": "{{ $currency }}",
                "name": "EV Charging Station",
                "description": "Payment for Booking",
                "order_id": "{{ $razorpayOrderId }}",
                "handler": function (response) {
                    alert("Payment successful! ID: " + response.razorpay_payment_id);
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('payment-form').submit();
                },
                "prefill": {
                    "name": "Your Name",
                    "email": "Your Email",
                    "contact": "Your Phone"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
</body>
</html>
