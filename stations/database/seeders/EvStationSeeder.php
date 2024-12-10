<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\EvStation;
use Faker\Factory as Faker;

class EvStationSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Prefixes and suffixes to create random EV-related names
        $prefixes = ['Volt', 'Eco', 'Power', 'Charge', 'Electro', 'Green', 'Electric', 'Clean', 'Energy'];
        $suffixes = ['Station', 'Hub', 'Charging Point', 'EV Point', 'Charge Point', 'Power Station', 'EV Hub'];

        // Generate random EV stations in Indore
        for ($i = 0; $i < 100; $i++) {
            $name = $faker->randomElement($prefixes) . ' ' . $faker->randomElement($suffixes);

            EvStation::create([
                'name' => $name,
                'address' => $faker->address,
                'latitude' => $faker->latitude(22.5, 23.5),  // Random latitude in Indore range
                'longitude' => $faker->longitude(75.5, 76.5),  // Random longitude in Indore range
            ]);
        }
    }
}
