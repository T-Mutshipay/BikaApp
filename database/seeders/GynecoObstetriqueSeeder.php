<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GynecoObstetriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['nom' => 'Gynécologie', 'departement_id' => 3], 
            ['nom' => 'Obstétrique', 'departement_id' => 3], 
            ['nom' => 'Salle d\'accouchement', 'departement_id' => 3], 
            ['nom' => 'Soins Obstétriques et Gynécologiques', 'departement_id' => 3]
        ]);
    }
}
