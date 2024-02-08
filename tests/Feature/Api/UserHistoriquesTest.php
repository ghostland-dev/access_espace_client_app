<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Historique;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHistoriquesTest extends TestCase
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
    public function it_gets_user_historiques(): void
    {
        $user = User::factory()->create();
        $historiques = Historique::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.historiques.index', $user));

        $response->assertOk()->assertSee($historiques[0]->action);
    }

    /**
     * @test
     */
    public function it_stores_the_user_historiques(): void
    {
        $user = User::factory()->create();
        $data = Historique::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.historiques.store', $user),
            $data
        );

        $this->assertDatabaseHas('historiques', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $historique = Historique::latest('id')->first();

        $this->assertEquals($user->id, $historique->user_id);
    }
}
