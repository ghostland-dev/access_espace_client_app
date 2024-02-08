<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'civilite' => $this->faker->text(255),
            'nom' => $this->faker->text(255),
            'prenom' => $this->faker->text(255),
            'fonction' => $this->faker->text(255),
            'mobile' => $this->faker->phoneNumber(),
            'fix' => $this->faker->phoneNumber(),
            'signataire' => $this->faker->boolean(),
            'decisionnaire' => $this->faker->boolean(),
            'site_id' => \App\Models\Site::factory(),
        ];
    }
}
