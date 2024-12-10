<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Nearby Stations</title>

    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="{{ asset('/css/option_style.css') }}" rel="stylesheet">

</head>
<body>
    <h1>Find Nearby Stations</h1>

    <!-- Buttons for Finding Nearby Stations -->
    <button id="findFuelStations" onclick="findStations('fuel')">Find Nearby Fuel Stations</button>
    <button id="findEVStations" onclick="findStations('ev')">Find Nearby EV Stations</button>

    <script>
        // Function to get the user's location and send it to backend with station type
        function findStations(stationType) {
            // Check if geolocation is available in the browser
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Get latitude and longitude from user's geolocation
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Create a hidden form dynamically
                    const form = document.createElement('form');
                    form.method = 'Get';
                    //form.action = '/find-stations'; // Endpoint to handle the request
                    form.action = stationType === 'ev' ? '/find-ev-stations' : '/find-fuel-stations'; // Update based on station type

                    // Create CSRF token input for the form
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = "{{ csrf_token() }}";
                    form.appendChild(csrfToken);

                    // Create latitude and longitude hidden fields
                    const latInput = document.createElement('input');
                    latInput.type = 'hidden';
                    latInput.name = 'latitude';
                    latInput.value = latitude;
                    form.appendChild(latInput);

                    const lonInput = document.createElement('input');
                    lonInput.type = 'hidden';
                    lonInput.name = 'longitude';
                    lonInput.value = longitude;
                    form.appendChild(lonInput);

                    // Create station type hidden field
                    const typeInput = document.createElement('input');
                    typeInput.type = 'hidden';
                    typeInput.name = 'station_type';
                    typeInput.value = stationType;
                    form.appendChild(typeInput);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }, function(error) {
                    alert("Unable to retrieve your location. Please make sure location services are enabled.");
                });
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        }
    </script>

</body>
</html>
