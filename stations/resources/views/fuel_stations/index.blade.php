<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nearby Fuel Stations</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Custom CSS -->
    <link href="{{ asset('/css/fuel_style.css') }}" rel="stylesheet">

</head>
<body>
     <!-- Title -->


    <!-- Map and Table Flip Card -->
    <div id="map-container">
    <header class="mb-6 text-center">
            <h1 >Near-by Fuel Stations</h1>
            <p> Your Location: Latitude {{ $latitude }}, Longitude {{ $longitude }}</p>
        </header>
        <div class="flip-card" id="flip-card">
            <!-- Front Side (Map) -->
            <div class="front">
                <div id="map" class="w-full h-full"></div>
            </div>

            <!-- Back Side (Table) -->
            <div class="back">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Fuel Stations</h2>
                @if($stations->isEmpty())
                    <p class="text-center text-gray-500">No stations found within 50km of your location.</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Distance (km)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stations as $station)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $station->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $station->address }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ round($station->distance, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $stations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Flip Button -->
    <div class="text-center">
        <button id="flip-button">Flip to View Table</button>
    </div>
    <!-- Home Button -->
      <a href="{{ route('home') }}" class="home-button">
         Home
      </a>


    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>


        // Initialize the map
        const map = L.map('map').setView([{{ $latitude }}, {{ $longitude }}], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add marker for user's location
        L.marker([{{ $latitude }}, {{ $longitude }}]).addTo(map)
            .bindPopup("Your Location")
            .openPopup();




        // Add markers for fuel stations
        @foreach($stations as $station)
            L.marker([{{ $station->latitude }}, {{ $station->longitude }}]).addTo(map)
                .bindPopup(`
                    <strong>{{ $station->name }}</strong><br>
                    {{ $station->address }}<br>
                    {{ round($station->distance, 2) }} km away
                `);
        @endforeach



        // Flip Card Logic
        const flipCard = document.getElementById('flip-card');
        const flipButton = document.getElementById('flip-button');

        flipButton.addEventListener('click', () => {
            flipCard.classList.toggle('show-table');
            flipButton.innerText = flipCard.classList.contains('show-table')
                ? 'Flip to View Map'
                : 'Flip to View Table';
        });
    </script>
</body>
</html>
