<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Score;
use App\Models\Entreprise;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntrepriseScoresTest extends TestCase
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
    public function it_gets_entreprise_scores(): void
    {
        $entreprise = Entreprise::factory()->create();
        $scores = Score::factory()
            ->count(2)
            ->create([
                'entreprise_id' => $entreprise->id,
            ]);

        $response = $this->getJson(
            route('api.entreprises.scores.index', $entreprise)
        );

        $response->assertOk()->assertSee($scores[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_entreprise_scores(): void
    {
        $entreprise = Entreprise::factory()->create();
        $data = Score::factory()
            ->make([
                'entreprise_id' => $entreprise->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.entreprises.scores.store', $entreprise),
            $data
        );

        $this->assertDatabaseHas('scores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $score = Score::latest('id')->first();

        $this->assertEquals($entreprise->id, $score->entreprise_id);
    }
}
