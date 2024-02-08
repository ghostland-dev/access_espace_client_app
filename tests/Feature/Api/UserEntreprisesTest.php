<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Entreprise;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEntreprisesTest extends TestCase
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
    public function it_gets_user_entreprises(): void
    {
        $user = User::factory()->create();
        $entreprises = Entreprise::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.entreprises.index', $user));

        $response->assertOk()->assertSee($entreprises[0]->raison_sociale);
    }

    /**
     * @test
     */
    public function it_stores_the_user_entreprises(): void
    {
        $user = User::factory()->create();
        $data = Entreprise::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.entreprises.store', $user),
            $data
        );

        $this->assertDatabaseHas('entreprises', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $entreprise = Entreprise::latest('id')->first();

        $this->assertEquals($user->id, $entreprise->user_id);
    }
}
