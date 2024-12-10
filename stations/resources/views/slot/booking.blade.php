<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body>
<br class="bg-gray-100 min-h-screen flex  justify-center ">

    <!-- Success/Error Popup -->
    @if (session('success') || session('error'))
        <div id="popupMessage" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-lg font-bold {{ session('success') ? 'text-green-600' : 'text-red-600' }}">
                    {{ session('success') ?? session('error') }}
                </h2>
                <button onclick="closePopup()" class="mt-4 bg-gray-700 text-white px-4 py-2 rounded shadow hover:bg-gray-800">
                    Close
                </button>
            </div>
        </div>
    @endif

    <!-- Main Booking Form -->
    <div class="mx-10" >
        <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center mt-4">Book Slot</h2>
        <form method="POST" action="{{ route('booking.store') }}" >
            @csrf
            <input type="hidden" name="station_id" value="{{ $stationId }}">
            <input type="hidden" name="status" id="status" value="pending">
            <!-- Table Structure -->
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-11 py-2 text-left">Car No</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">Car Model</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">Units</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">Start Time</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">End Time</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">Total Price</th>
                        <th class="border border-gray-300 px-11 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" id="car_no" name="car_no" class="w-full p-2 border rounded" placeholder="Enter Car No" required>
                        </td>

                        <td class="border border-gray-300 px-4 py-2">
                          <select id="car_id" name="car_id" class="w-full p-3 border rounded dropdown-select" required onchange="calculateTotalPrice()">
                                <option value="">Select Car Model</option>
                                @foreach ($cars as $car)
                           <option value="{{ $car->id }}" data-unit-price="{{ $car->unit_price }}">
                               {{ $car->model }}
                           </option>
                          @endforeach
                         </select>
                        </td>

                        <td class="border border-gray-300 px-4 py-2">
                            <input type="number" id="units" name="units" class="w-full p-2 border rounded" min="1" value="1" required onchange="calculateTotalPrice()">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="datetime-local" id="start_time" name="start_time" class="w-full p-2 border rounded" required>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="datetime-local" id="end_time" name="end_time" class="w-full p-2 border rounded" required>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <p id="totalPrice" class="text-lg font-semibold">₹0</p>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                           <p id="statusText" class="text-lg font-semibold text-green-600">Available</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-orange-600">
                    Book Now
                </button>
            </div>
        </form>
    </div> <br\>


    <!-- Manish Singh -->

    <!-- Slot Booking Details Table -->
<div class="mx-10 mt-14">
    <h2 class="text-2xl font-bold mb-4 text-gray-700 text-center">Slot Booking Details</h2>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-6 py-2 text-left">Station</th>
                <th class="border border-gray-300 px-6 py-2 text-left">Car Model</th>
                <th class="border border-gray-300 px-6 py-2 text-left">Start Time</th>
                <th class="border border-gray-300 px-6 py-2 text-left">End Time</th>
                <th class="border border-gray-300 px-6 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->slot->station->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->car->model }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->slot->start_time }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->slot->end_time }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-green-600">
                        {{ $booking->status == 'pending' ? 'Pending' : 'Completed' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>









    <script>
        // Function to calculate total price
        function calculateTotalPrice() {
            const carSelect = document.getElementById('car_id');
            const selectedCar = carSelect.options[carSelect.selectedIndex];
            const unitPrice = parseFloat(selectedCar.getAttribute('data-unit-price')) || 0;
            const units = parseInt(document.getElementById('units').value) || 0;
            const totalPrice = unitPrice * units;
            document.getElementById('totalPrice').innerText = `₹${totalPrice.toFixed(2)}`;
        }

        // Function to close the popup
        function closePopup() {
            const popup = document.getElementById('popupMessage');
            if (popup) {
                popup.style.display = 'none';
            }
        }
    </script>


 <!-- Home Button -->
  <div class="mt-6 text-center  space-x-4">
     <a href="{{ route('home') }}" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Home
      </a>

     <a href="http://127.0.0.1:8000/find-ev-stations?_token=WNaIdSbaXnXNtNTg8ySxmZOXKN5IvcyIOFefORLi&latitude=22.729365281124572&longitude=75.89561426287781&station_type=ev" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Back
      </a>
  </div>
</body>
</html>
