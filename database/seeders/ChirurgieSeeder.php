<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChirurgieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['nom' => 'Urgences - Chirurgie', 'departement_id' => 2], 
            ['nom' => 'Soins Intensifs', 'departement_id' => 2], 
            ['nom' => 'Urologie', 'departement_id' => 2], 
            ['nom' => 'Thoracique', 'departement_id' => 2], 
            ['nom' => 'Neurologie', 'departement_id' => 2], 
            ['nom' => 'Traumato-orthopedie', 'departement_id' => 2], 
            ['nom' => 'Digestive', 'departement_id' => 2], 
            ['nom' => 'Chirurgie Plastique', 'departement_id' => 2], 
            ['nom' => 'Chirurgie Pédiatrique', 'departement_id' => 2], 
            ['nom' => 'Maxillo-faciale', 'departement_id' => 2]
        ]);
    }
}
