<?php

namespace Database\Factories;

use App\Models\Historique;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoriqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historique::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'action' => $this->faker->text(255),
            'type' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
            'entreprise_id' => \App\Models\Entreprise::factory(),
        ];
    }
}
