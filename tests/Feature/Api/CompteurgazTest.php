<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Compteurgaz;

use App\Models\Site;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompteurgazTest extends TestCase
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
    public function it_gets_compteurgazs_list(): void
    {
        $compteurgazs = Compteurgaz::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compteurgazs.index'));

        $response->assertOk()->assertSee($compteurgazs[0]->PCE);
    }

    /**
     * @test
     */
    public function it_stores_the_compteurgaz(): void
    {
        $data = Compteurgaz::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.compteurgazs.store'), $data);

        $this->assertDatabaseHas('compteurgazs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_compteurgaz(): void
    {
        $compteurgaz = Compteurgaz::factory()->create();

        $site = Site::factory()->create();

        $data = [
            'PCE' => $this->faker->text(255),
            'site_id' => $site->id,
        ];

        $response = $this->putJson(
            route('api.compteurgazs.update', $compteurgaz),
            $data
        );

        $data['id'] = $compteurgaz->id;

        $this->assertDatabaseHas('compteurgazs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compteurgaz(): void
    {
        $compteurgaz = Compteurgaz::factory()->create();

        $response = $this->deleteJson(
            route('api.compteurgazs.destroy', $compteurgaz)
        );

        $this->assertModelMissing($compteurgaz);

        $response->assertNoContent();
    }
}
