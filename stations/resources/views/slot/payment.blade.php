<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url('/images/payment3.jpg')] bg-center  bg-no-repeat  min-h-screen flex items-center justify-center" >
<!-- style="background-image: url('/images/payment3.jpg'); background-repeat:no-repeat;" -->
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
        <form action="{{ route('payment.confirm', $booking->id) }}" method="POST" class="mt-6">
            @csrf
            <label for="payment_method" class="block text-gray-700 font-semibold mb-2">Choose Payment Method:</label>
            <select name="payment_method" id="payment_method" class="w-full p-2 border rounded mb-4" required>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI</option>
                <option value="net_banking">Net Banking</option>
            </select>
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded shadow hover:bg-orange-600">
                Confirm Payment
            </button>
        </form>
    </div>


    <!-- Home Button -->
  <div class=" absolute top-4 left-4 mt-6 space-x-4">
     <a href="{{ route('home') }}" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Home
      </a>

     <a href="http://127.0.0.1:8000/find-ev-stations?_token=WNaIdSbaXnXNtNTg8ySxmZOXKN5IvcyIOFefORLi&latitude=22.729365281124572&longitude=75.89561426287781&station_type=ev" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Back
      </a>
      </div>
</body>
</html>
