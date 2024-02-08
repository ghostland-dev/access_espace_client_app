<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Cahiercharge;

use App\Models\Site;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CahierchargeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_cahiercharges(): void
    {
        $cahiercharges = Cahiercharge::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('cahiercharges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.cahiercharges.index')
            ->assertViewHas('cahiercharges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_cahiercharge(): void
    {
        $response = $this->get(route('cahiercharges.create'));

        $response->assertOk()->assertViewIs('app.cahiercharges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_cahiercharge(): void
    {
        $data = Cahiercharge::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('cahiercharges.store'), $data);

        $this->assertDatabaseHas('cahiercharges', $data);

        $cahiercharge = Cahiercharge::latest('id')->first();

        $response->assertRedirect(route('cahiercharges.edit', $cahiercharge));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_cahiercharge(): void
    {
        $cahiercharge = Cahiercharge::factory()->create();

        $response = $this->get(route('cahiercharges.show', $cahiercharge));

        $response
            ->assertOk()
            ->assertViewIs('app.cahiercharges.show')
            ->assertViewHas('cahiercharge');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_cahiercharge(): void
    {
        $cahiercharge = Cahiercharge::factory()->create();

        $response = $this->get(route('cahiercharges.edit', $cahiercharge));

        $response
            ->assertOk()
            ->assertViewIs('app.cahiercharges.edit')
            ->assertViewHas('cahiercharge');
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

        $response = $this->put(
            route('cahiercharges.update', $cahiercharge),
            $data
        );

        $data['id'] = $cahiercharge->id;

        $this->assertDatabaseHas('cahiercharges', $data);

        $response->assertRedirect(route('cahiercharges.edit', $cahiercharge));
    }

    /**
     * @test
     */
    public function it_deletes_the_cahiercharge(): void
    {
        $cahiercharge = Cahiercharge::factory()->create();

        $response = $this->delete(
            route('cahiercharges.destroy', $cahiercharge)
        );

        $response->assertRedirect(route('cahiercharges.index'));

        $this->assertModelMissing($cahiercharge);
    }
}
