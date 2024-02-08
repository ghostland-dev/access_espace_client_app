<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Site;
use App\Models\Compteurelec;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteCompteurelecsTest extends TestCase
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
    public function it_gets_site_compteurelecs(): void
    {
        $site = Site::factory()->create();
        $compteurelecs = Compteurelec::factory()
            ->count(2)
            ->create([
                'site_id' => $site->id,
            ]);

        $response = $this->getJson(
            route('api.sites.compteurelecs.index', $site)
        );

        $response->assertOk()->assertSee($compteurelecs[0]->PDL);
    }

    /**
     * @test
     */
    public function it_stores_the_site_compteurelecs(): void
    {
        $site = Site::factory()->create();
        $data = Compteurelec::factory()
            ->make([
                'site_id' => $site->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sites.compteurelecs.store', $site),
            $data
        );

        $this->assertDatabaseHas('compteurelecs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $compteurelec = Compteurelec::latest('id')->first();

        $this->assertEquals($site->id, $compteurelec->site_id);
    }
}
