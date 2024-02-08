<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Entreprise;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntrepriseTest extends TestCase
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
    public function it_gets_entreprises_list(): void
    {
        $entreprises = Entreprise::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.entreprises.index'));

        $response->assertOk()->assertSee($entreprises[0]->raison_sociale);
    }

    /**
     * @test
     */
    public function it_stores_the_entreprise(): void
    {
        $data = Entreprise::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.entreprises.store'), $data);

        $this->assertDatabaseHas('entreprises', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_entreprise(): void
    {
        $entreprise = Entreprise::factory()->create();

        $user = User::factory()->create();

        $data = [
            'raison_sociale' => $this->faker->text(255),
            'siren' => $this->faker->text(255),
            'siret' => $this->faker->text(255),
            'ville' => $this->faker->text(255),
            'code_postal' => $this->faker->text(255),
            'adresse' => $this->faker->text(255),
            'details' => $this->faker->sentence(20),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.entreprises.update', $entreprise),
            $data
        );

        $data['id'] = $entreprise->id;

        $this->assertDatabaseHas('entreprises', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_entreprise(): void
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->deleteJson(
            route('api.entreprises.destroy', $entreprise)
        );

        $this->assertModelMissing($entreprise);

        $response->assertNoContent();
    }
}
