<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Room::factory(10)->create();
        Patient::factory()->count(50)->create();
        $this->call([
            // DepartementSeeder::class,
            ServiceSeeder::class,
            DepartementSeeder::class,
            GynecoObstetriqueSeeder::class,
            ChirurgieSeeder::class,
            UserSeeder::class,
            PediatrieSeeder::class,
        ]);
    }
}
