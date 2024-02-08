<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Compteurgaz;

use App\Models\Site;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompteurgazControllerTest extends TestCase
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
    public function it_displays_index_view_with_compteurgazs(): void
    {
        $compteurgazs = Compteurgaz::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compteurgazs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurgazs.index')
            ->assertViewHas('compteurgazs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compteurgaz(): void
    {
        $response = $this->get(route('compteurgazs.create'));

        $response->assertOk()->assertViewIs('app.compteurgazs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compteurgaz(): void
    {
        $data = Compteurgaz::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compteurgazs.store'), $data);

        $this->assertDatabaseHas('compteurgazs', $data);

        $compteurgaz = Compteurgaz::latest('id')->first();

        $response->assertRedirect(route('compteurgazs.edit', $compteurgaz));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compteurgaz(): void
    {
        $compteurgaz = Compteurgaz::factory()->create();

        $response = $this->get(route('compteurgazs.show', $compteurgaz));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurgazs.show')
            ->assertViewHas('compteurgaz');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compteurgaz(): void
    {
        $compteurgaz = Compteurgaz::factory()->create();

        $response = $this->get(route('compteurgazs.edit', $compteurgaz));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurgazs.edit')
            ->assertViewHas('compteurgaz');
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

        $response = $this->put(
            route('compteurgazs.update', $compteurgaz),
            $data
        );

        $data['id'] = $compteurgaz->id;

        $this->assertDatabaseHas('compteurgazs', $data);

        $response->assertRedirect(route('compteurgazs.edit', $compteurgaz));
    }

    /**
     * @test
     */
    public function it_deletes_the_compteurgaz(): void
    {
        $compteurgaz = Compteurgaz::factory()->create();

        $response = $this->delete(route('compteurgazs.destroy', $compteurgaz));

        $response->assertRedirect(route('compteurgazs.index'));

        $this->assertModelMissing($compteurgaz);
    }
}
