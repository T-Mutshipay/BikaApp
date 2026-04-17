<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            ['nom' => 'Urgences - Médecine Interne ', 'departement_id' => 1],
            ['nom' => 'Soins Intensifs', 'departement_id' => 1],
            ['nom' => 'Hepato-gastro-entérologie', 'departement_id' => 1],
            ['nom' => 'Maladies infectieuses et parasitaires (MIP)', 'departement_id' => 1],
            ['nom' => 'Cardiologie', 'departement_id' => 1],
            ['nom' => 'Néphrologie', 'departement_id' => 1],
            ['nom' => 'Endocrinologie', 'departement_id' => 1],
            ['nom' => 'Pneumologie', 'departement_id' => 1],
            ['nom' => 'Hemato-rhumatologie', 'departement_id' => 1],
        ]);
    }
}
