<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Entreprise;
use App\Models\Historique;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntrepriseHistoriquesTest extends TestCase
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
    public function it_gets_entreprise_historiques(): void
    {
        $entreprise = Entreprise::factory()->create();
        $historiques = Historique::factory()
            ->count(2)
            ->create([
                'entreprise_id' => $entreprise->id,
            ]);

        $response = $this->getJson(
            route('api.entreprises.historiques.index', $entreprise)
        );

        $response->assertOk()->assertSee($historiques[0]->action);
    }

    /**
     * @test
     */
    public function it_stores_the_entreprise_historiques(): void
    {
        $entreprise = Entreprise::factory()->create();
        $data = Historique::factory()
            ->make([
                'entreprise_id' => $entreprise->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.entreprises.historiques.store', $entreprise),
            $data
        );

        $this->assertDatabaseHas('historiques', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $historique = Historique::latest('id')->first();

        $this->assertEquals($entreprise->id, $historique->entreprise_id);
    }
}
