<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Site;

use App\Models\Entreprise;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteControllerTest extends TestCase
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
    public function it_displays_index_view_with_sites(): void
    {
        $sites = Site::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sites.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sites.index')
            ->assertViewHas('sites');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_site(): void
    {
        $response = $this->get(route('sites.create'));

        $response->assertOk()->assertViewIs('app.sites.create');
    }

    /**
     * @test
     */
    public function it_stores_the_site(): void
    {
        $data = Site::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sites.store'), $data);

        $this->assertDatabaseHas('sites', $data);

        $site = Site::latest('id')->first();

        $response->assertRedirect(route('sites.edit', $site));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_site(): void
    {
        $site = Site::factory()->create();

        $response = $this->get(route('sites.show', $site));

        $response
            ->assertOk()
            ->assertViewIs('app.sites.show')
            ->assertViewHas('site');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_site(): void
    {
        $site = Site::factory()->create();

        $response = $this->get(route('sites.edit', $site));

        $response
            ->assertOk()
            ->assertViewIs('app.sites.edit')
            ->assertViewHas('site');
    }

    /**
     * @test
     */
    public function it_updates_the_site(): void
    {
        $site = Site::factory()->create();

        $entreprise = Entreprise::factory()->create();

        $data = [
            'siret' => $this->faker->text(255),
            'ville' => $this->faker->text(255),
            'code_postal' => $this->faker->text(255),
            'adresse' => $this->faker->text(255),
            'entreprise_id' => $entreprise->id,
        ];

        $response = $this->put(route('sites.update', $site), $data);

        $data['id'] = $site->id;

        $this->assertDatabaseHas('sites', $data);

        $response->assertRedirect(route('sites.edit', $site));
    }

    /**
     * @test
     */
    public function it_deletes_the_site(): void
    {
        $site = Site::factory()->create();

        $response = $this->delete(route('sites.destroy', $site));

        $response->assertRedirect(route('sites.index'));

        $this->assertModelMissing($site);
    }
}
