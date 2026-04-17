<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PediatrieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['nom' => 'Urgences - Pédiatrique', 'departement_id' => 4], 
            ['nom' => 'Soins Intensifs', 'departement_id' => 4], 
            ['nom' => 'Néonatalogie Unité A', 'departement_id' => 4], 
            ['nom' => 'Néonatalogie Unité B', 'departement_id' => 4], 
            ['nom' => 'Nutrition-Hepato-gastro-enterologie Unité C', 'departement_id' => 4], 
            ['nom' => 'Cardio-pneumologie Unité D', 'departement_id' => 4], 
            ['nom' => 'Nephro-pédiatrie', 'departement_id' => 4], 
            ['nom' => 'Hemato-oncologie', 'departement_id' => 4], 
            ['nom' => 'Génétique', 'departement_id' => 4],
        ]);
    }
}
