<?php

namespace Database\Factories;

use App\Models\Compteurgaz;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompteurgazFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compteurgaz::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'PCE' => $this->faker->text(255),
            'site_id' => \App\Models\Site::factory(),
        ];
    }
}
