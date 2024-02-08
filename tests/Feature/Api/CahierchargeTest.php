<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Cahiercharge;

use App\Models\Site;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CahierchargeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_cahiercharges_list(): void
    {
        $cahiercharges = Cahiercharge::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.cahiercharges.index'));

        $response->assertOk()->assertSee($cahiercharges[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_cahiercharge(): void
    {
        $data = Cahiercharge::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.cahiercharges.store'), $data);

        $this->assertDatabaseHas('cahiercharges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_cahiercharge(): void
    {
        $cahiercharge = Cahiercharge::factory()->create();

        $site = Site::factory()->create();

        $data = [
            'duree_contrat' => 'Sans Engagement',
            'energie_verte' => 'Oui',
            'encouter_les_opportunites' => $this->faker->boolean(),
            'frequence_facturation' => 'Mensuelle',
            'type_offre' => 'Prix fix 100% marché',
            'mode_paiement' => 'Prélevement Bancaire',
            'offre_fournisseur' => 'Offre à titre indicative',
            'site_id' => $site->id,
        ];

        $response = $this->putJson(
            route('api.cahiercharges.update', $cahiercharge),
            $data
        );

        $data['id'] = $cahiercharge->id;

        $this->assertDatabaseHas('cahiercharges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_cahiercharge(): void
    {
        $cahiercharge = Cahiercharge::factory()->create();

        $response = $this->deleteJson(
            route('api.cahiercharges.destroy', $cahiercharge)
        );

        $this->assertModelMissing($cahiercharge);

        $response->assertNoContent();
    }
}
