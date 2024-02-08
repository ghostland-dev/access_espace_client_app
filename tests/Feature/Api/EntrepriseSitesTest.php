<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Site;
use App\Models\Entreprise;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntrepriseSitesTest extends TestCase
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
    public function it_gets_entreprise_sites(): void
    {
        $entreprise = Entreprise::factory()->create();
        $sites = Site::factory()
            ->count(2)
            ->create([
                'entreprise_id' => $entreprise->id,
            ]);

        $response = $this->getJson(
            route('api.entreprises.sites.index', $entreprise)
        );

        $response->assertOk()->assertSee($sites[0]->siret);
    }

    /**
     * @test
     */
    public function it_stores_the_entreprise_sites(): void
    {
        $entreprise = Entreprise::factory()->create();
        $data = Site::factory()
            ->make([
                'entreprise_id' => $entreprise->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.entreprises.sites.store', $entreprise),
            $data
        );

        $this->assertDatabaseHas('sites', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $site = Site::latest('id')->first();

        $this->assertEquals($entreprise->id, $site->entreprise_id);
    }
}
