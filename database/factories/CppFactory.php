<?php

namespace Database\Factories;

use App\Models\Cpp;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CppFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cpp::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fichier' => $this->faker->text(255),
            'signe' => $this->faker->boolean(),
            'contact_id' => \App\Models\Contact::factory(),
        ];
    }
}
