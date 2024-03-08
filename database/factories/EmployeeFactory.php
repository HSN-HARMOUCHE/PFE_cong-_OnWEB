<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mat' => $this->faker->unique()->numberBetween(1000, 9999),
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'date_naiss' => $this->faker->date,
            'date_recrutement' => $this->faker->date,
            'fonction' => $this->faker->randomElement(['Directeur', 'formateur','directeur complexe','magasinier']),
            'situation_fam' => $this->faker->randomElement(['Célibataire', 'marie']),
            'nbr_enfants' => $this->faker->numberBetween(0, 5),
            'secteur' =>$this->faker->randomElement(['Administration', 'AGC','BTP','NTIC']),
            'grade' => $this->faker->word,
            'echelle' => $this->faker->numberBetween(9,11),
            'statue' =>$this->faker->randomElement(['statutaire', 'vacataire','contractuel','coopérant']),
            'psw_cnx' => bcrypt('password'), // Adjust the default password
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
