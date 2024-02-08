<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Site;
use App\Models\Cahiercharge;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteCahierchargesTest extends TestCase
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
    public function it_gets_site_cahiercharges(): void
    {
        $site = Site::factory()->create();
        $cahiercharges = Cahiercharge::factory()
            ->count(2)
            ->create([
                'site_id' => $site->id,
            ]);

        $response = $this->getJson(
            route('api.sites.cahiercharges.index', $site)
        );

        $response->assertOk()->assertSee($cahiercharges[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_site_cahiercharges(): void
    {
        $site = Site::factory()->create();
        $data = Cahiercharge::factory()
            ->make([
                'site_id' => $site->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sites.cahiercharges.store', $site),
            $data
        );

        $this->assertDatabaseHas('cahiercharges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $cahiercharge = Cahiercharge::latest('id')->first();

        $this->assertEquals($site->id, $cahiercharge->site_id);
    }
}
