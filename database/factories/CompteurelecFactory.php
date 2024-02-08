<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Compteurelec;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompteurelecFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compteurelec::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'PDL' => $this->faker->text(255),
            'site_id' => \App\Models\Site::factory(),
        ];
    }
}
