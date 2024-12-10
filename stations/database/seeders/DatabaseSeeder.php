<?php

namespace Database\Seeders;

use Database\Seeders\EvStationSeeder;
use App\Models\User;
// use EvStationSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use APP\Models\EvStation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            EvStationSeeder::class,
        ]);
    }
}
