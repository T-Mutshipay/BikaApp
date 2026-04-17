<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Dr. Jean Dupont',
                'specialite' => 'Cardiologie',
                'telephone' => '0123456789',
                'email' => 'jean.dupont@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Marie Curie',
                'specialite' => 'Radiologie',
                'telephone' => '0987654321',
                'email' => 'marie.curie@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Jacques Lambert',
                'specialite' => 'Pédiatrie',
                'telephone' => '0678901234',
                'email' => 'jacques.lambert@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Alice Moreau',
                'specialite' => 'Neurologie',
                'telephone' => '0789012345',
                'email' => 'alice.moreau@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Thomas Bernard',
                'specialite' => 'Orthopédie',
                'telephone' => '0456789012',
                'email' => 'thomas.bernard@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Laura Martin',
                'specialite' => 'Gynécologie',
                'telephone' => '0567890123',
                'email' => 'laura.martin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Paul Henry',
                'specialite' => 'Hématologie',
                'telephone' => '0678901234',
                'email' => 'paul.henry@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Emma Roux',
                'specialite' => 'Pneumologie',
                'telephone' => '0789012345',
                'email' => 'emma.roux@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Lucas Petit',
                'specialite' => 'Dermatologie',
                'telephone' => '0456789012',
                'email' => 'lucas.petit@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Clara Dubois',
                'specialite' => 'Ophtalmologie',
                'telephone' => '0567890123',
                'email' => 'clara.dubois@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
