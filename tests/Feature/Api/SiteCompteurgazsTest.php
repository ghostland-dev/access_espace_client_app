<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Site;
use App\Models\Compteurgaz;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteCompteurgazsTest extends TestCase
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
    public function it_gets_site_compteurgazs(): void
    {
        $site = Site::factory()->create();
        $compteurgazs = Compteurgaz::factory()
            ->count(2)
            ->create([
                'site_id' => $site->id,
            ]);

        $response = $this->getJson(
            route('api.sites.compteurgazs.index', $site)
        );

        $response->assertOk()->assertSee($compteurgazs[0]->PCE);
    }

    /**
     * @test
     */
    public function it_stores_the_site_compteurgazs(): void
    {
        $site = Site::factory()->create();
        $data = Compteurgaz::factory()
            ->make([
                'site_id' => $site->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sites.compteurgazs.store', $site),
            $data
        );

        $this->assertDatabaseHas('compteurgazs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compteurgaz = Compteurgaz::latest('id')->first();

        $this->assertEquals($site->id, $compteurgaz->site_id);
    }
}
