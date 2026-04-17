<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Patient::class;
    
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'date_naissance' => $this->faker->date('Y-m-d', '2005-12-31'),
            'genre' => $this->faker->randomElement(['Masculin', 'Féminin']),
            'adresse'=> $this->faker->address,
            'telephone'=> $this->faker->phoneNumber,
            'email'=> $this->faker->email,
        ];
    }
}
