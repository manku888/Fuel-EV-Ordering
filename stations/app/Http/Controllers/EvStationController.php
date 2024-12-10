<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelStation;
use App\Models\EvStation;
use Illuminate\Support\Facades\DB;

class EvStationController extends Controller
{
    public function findStations(Request $request)
    {
        // User ke latitude aur longitude ko accept karna
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $stationType = $request->input('station_type');

        // Validate incoming data
        if (!$latitude || !$longitude) {
            return back()->with('error', 'Latitude and Longitude are required.');
        }

        // ev
        if ($stationType=='ev') {
            # code...

        // Haversine Formula for distance calculation
        $stations = EvStation::select(

            'id',
            'name',
            'address',
            'latitude',
            'longitude',
            DB::raw("(
                6371 * acos(
                    cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude))
                )
            ) AS distance")
        )
        ->setBindings([$latitude, $longitude, $latitude]) // Bind latitude and longitude
        ->having('distance', '<', 50) // Only stations within 50km
        ->orderBy('distance', 'asc') // Sort by nearest
        ->paginate(8)
        ->appends($request->query());

        // Pass stations and user location to the view
        return view('ev_stations.index', [
            'stations' => $stations,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
     }
     }
}



