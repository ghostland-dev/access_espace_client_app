<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Score;

use App\Models\Entreprise;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreTest extends TestCase
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
    public function it_gets_scores_list(): void
    {
        $scores = Score::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.scores.index'));

        $response->assertOk()->assertSee($scores[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_score(): void
    {
        $data = Score::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.scores.store'), $data);

        $this->assertDatabaseHas('scores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_score(): void
    {
        $score = Score::factory()->create();

        $entreprise = Entreprise::factory()->create();

        $data = [
            'creditsafe' => $this->faker->randomNumber(0),
            'elipro' => $this->faker->randomNumber(0),
            'entreprise_id' => $entreprise->id,
        ];

        $response = $this->putJson(route('api.scores.update', $score), $data);

        $data['id'] = $score->id;

        $this->assertDatabaseHas('scores', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_score(): void
    {
        $score = Score::factory()->create();

        $response = $this->deleteJson(route('api.scores.destroy', $score));

        $this->assertModelMissing($score);

        $response->assertNoContent();
    }
}
