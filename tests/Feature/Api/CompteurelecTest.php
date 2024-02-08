<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Compteurelec;

use App\Models\Site;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompteurelecTest extends TestCase
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
    public function it_gets_compteurelecs_list(): void
    {
        $compteurelecs = Compteurelec::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.compteurelecs.index'));

        $response->assertOk()->assertSee($compteurelecs[0]->PDL);
    }

    /**
     * @test
     */
    public function it_stores_the_compteurelec(): void
    {
        $data = Compteurelec::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.compteurelecs.store'), $data);

        $this->assertDatabaseHas('compteurelecs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_compteurelec(): void
    {
        $compteurelec = Compteurelec::factory()->create();

        $site = Site::factory()->create();

        $data = [
            'PDL' => $this->faker->text(255),
            'site_id' => $site->id,
        ];

        $response = $this->putJson(
            route('api.compteurelecs.update', $compteurelec),
            $data
        );

        $data['id'] = $compteurelec->id;

        $this->assertDatabaseHas('compteurelecs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_compteurelec(): void
    {
        $compteurelec = Compteurelec::factory()->create();

        $response = $this->deleteJson(
            route('api.compteurelecs.destroy', $compteurelec)
        );

        $this->assertModelMissing($compteurelec);

        $response->assertNoContent();
    }
}
