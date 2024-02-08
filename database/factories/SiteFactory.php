<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siret' => $this->faker->text(255),
            'ville' => $this->faker->text(255),
            'code_postal' => $this->faker->text(255),
            'adresse' => $this->faker->text(255),
            'entreprise_id' => \App\Models\Entreprise::factory(),
        ];
    }
}
