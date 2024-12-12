<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6 bg-[url(/images/b1.jpg)]">
    <div class=" mx-auto  p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Booking Details</h2>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
        @endif

        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">Car No.</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Car Model</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Units</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Start Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">End Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Payments</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->car_no }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->car->model }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->units }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $booking->slot->start_time }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $booking->slot->end_time }}</td>
                    <td class="border border-gray-300 px-4 py-2">₹{{ $booking->total_price }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $booking->status }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center" >
                        @if ($booking->status === 'pending')
                        <a href="{{ route('payment.show', $booking->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-orange-600">
                            Make Payment
                        </a>
                        @else
                        <span class="text-green-600 font-semibold">Paid</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- paginatio link-->
         <div class="mt-4">
            {{$bookings->links()}}
         </div>
    </div>


  <div class="mt-6 text-center  space-x-4">
     <a href="{{ route('home') }}" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Home
      </a>

     <a href="http://127.0.0.1:8000/find-ev-stations?_token=WNaIdSbaXnXNtNTg8ySxmZOXKN5IvcyIOFefORLi&latitude=22.729365281124572&longitude=75.89561426287781&station_type=ev" class="home-button bg-blue-500 text-white px-4 py-2  rounded shadow hover:bg-orange-600">
         Back
      </a>
</body>

</html>
