<?php

namespace Database\Factories;

use App\Models\Score;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creditsafe' => $this->faker->randomNumber(0),
            'elipro' => $this->faker->randomNumber(0),
            'entreprise_id' => \App\Models\Entreprise::factory(),
        ];
    }
}
