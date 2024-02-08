<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Entreprise;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntrepriseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_entreprises(): void
    {
        $entreprises = Entreprise::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('entreprises.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.entreprises.index')
            ->assertViewHas('entreprises');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_entreprise(): void
    {
        $response = $this->get(route('entreprises.create'));

        $response->assertOk()->assertViewIs('app.entreprises.create');
    }

    /**
     * @test
     */
    public function it_stores_the_entreprise(): void
    {
        $data = Entreprise::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('entreprises.store'), $data);

        $this->assertDatabaseHas('entreprises', $data);

        $entreprise = Entreprise::latest('id')->first();

        $response->assertRedirect(route('entreprises.edit', $entreprise));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_entreprise(): void
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->get(route('entreprises.show', $entreprise));

        $response
            ->assertOk()
            ->assertViewIs('app.entreprises.show')
            ->assertViewHas('entreprise');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_entreprise(): void
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->get(route('entreprises.edit', $entreprise));

        $response
            ->assertOk()
            ->assertViewIs('app.entreprises.edit')
            ->assertViewHas('entreprise');
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

        $response = $this->put(route('entreprises.update', $entreprise), $data);

        $data['id'] = $entreprise->id;

        $this->assertDatabaseHas('entreprises', $data);

        $response->assertRedirect(route('entreprises.edit', $entreprise));
    }

    /**
     * @test
     */
    public function it_deletes_the_entreprise(): void
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->delete(route('entreprises.destroy', $entreprise));

        $response->assertRedirect(route('entreprises.index'));

        $this->assertModelMissing($entreprise);
    }
}
