<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = ['TATA Punch', 'BMW 320i', 'Hyundai Creta', 'Honda City', 'Kia Seltos'];
        $prices = [70.00, 95.00, 80.50, 65.75, 100.00];

        // Shuffle models to avoid duplicates
        shuffle($models);

        for ($i = 0; $i < 50; $i++) {
            Car::create([

                'model' => $models[$i % count($models)],  // Assigning unique model names
                'unit_price' => $prices[array_rand($prices)],
            ]);
        }
    }
}
