<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Cahiercharge;
use Illuminate\Database\Eloquent\Factories\Factory;

class CahierchargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cahiercharge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'duree_contrat' => 'Sans Engagement',
            'energie_verte' => 'Oui',
            'encouter_les_opportunites' => $this->faker->boolean(),
            'frequence_facturation' => 'Mensuelle',
            'type_offre' => 'Prix fix 100% marché',
            'mode_paiement' => 'Prélevement Bancaire',
            'offre_fournisseur' => 'Offre à titre indicative',
            'site_id' => \App\Models\Site::factory(),
        ];
    }
}
