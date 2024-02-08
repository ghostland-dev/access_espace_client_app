<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entreprise::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'raison_sociale' => $this->faker->text(255),
            'siren' => $this->faker->text(255),
            'siret' => $this->faker->text(255),
            'ville' => $this->faker->text(255),
            'code_postal' => $this->faker->text(255),
            'adresse' => $this->faker->text(255),
            'details' => $this->faker->sentence(20),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
