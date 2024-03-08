<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeConge ; 
use App\Models\Employee ; 
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conge>
 */
class CongeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = $this->faker->dateTimeBetween('2021-01-01', '2025-12-31'); 
        $dateFin = Carbon::instance($dateDebut)->addDays($this->faker->numberBetween(1, 30));
        return [
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'statue' => $this->faker->randomElement(['accepte','en attendant','refuse']),
            'id_type' => function () {
                return $this->faker->randomElement(TypeConge::pluck('id_type'));
            },
            'mat_emp' => function () {
                return $this->faker->randomElement(Employee::pluck('mat'));
            },
        ];

    }

}
