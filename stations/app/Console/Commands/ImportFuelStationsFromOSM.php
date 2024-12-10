<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportFuelStationsFromOSM extends Command
{
    protected $signature = 'import:osm-fuel-stations';
    protected $description = 'Fetch fuel stations data from OpenStreetMap and store it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Overpass API URL
        $url = 'https://overpass-api.de/api/interpreter';


        // Overpass query to get fuel stations (name, latitude, longitude, address)
        $query = '[out:json];
        node["amenity"="fuel"](22.5,75.5,23.0,76.0);
        out body;
          ';


        // Send request to Overpass API using Laravel's HTTP client
        $response = Http::get($url, ['data' => $query]);





        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();

            // Loop through the elements (fuel stations) and insert them into the database
            foreach ($data['elements'] as $element) {
                // Get the tags and coordinates
                $tags = $element['tags'];
                $latitude = $element['lat'];
                $longitude = $element['lon'];

                // Check if name exists, otherwise use brand
                $name = $tags['name'] ?? $tags['brand'] ?? 'Unknown';

                // Check if address exists, otherwise combine city and street
                $address = $tags['addr:full'] ??
                           ($tags['addr:street'] ?? '') . ' ' .
                           ($tags['addr:city'] ?? 'Unknown city');

                // Insert into database
                DB::table('fuel_stations')->insert([
                    'name' => $name,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'address' => $address,
                ]);
            }

            $this->info('Fuel stations data imported successfully!');
        } else {
            $this->error('Failed to fetch data from OpenStreetMap.');
        }
    }
}
