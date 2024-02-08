<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Compteurelec;

use App\Models\Site;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompteurelecControllerTest extends TestCase
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
    public function it_displays_index_view_with_compteurelecs(): void
    {
        $compteurelecs = Compteurelec::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('compteurelecs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurelecs.index')
            ->assertViewHas('compteurelecs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_compteurelec(): void
    {
        $response = $this->get(route('compteurelecs.create'));

        $response->assertOk()->assertViewIs('app.compteurelecs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_compteurelec(): void
    {
        $data = Compteurelec::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('compteurelecs.store'), $data);

        $this->assertDatabaseHas('compteurelecs', $data);

        $compteurelec = Compteurelec::latest('id')->first();

        $response->assertRedirect(route('compteurelecs.edit', $compteurelec));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_compteurelec(): void
    {
        $compteurelec = Compteurelec::factory()->create();

        $response = $this->get(route('compteurelecs.show', $compteurelec));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurelecs.show')
            ->assertViewHas('compteurelec');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_compteurelec(): void
    {
        $compteurelec = Compteurelec::factory()->create();

        $response = $this->get(route('compteurelecs.edit', $compteurelec));

        $response
            ->assertOk()
            ->assertViewIs('app.compteurelecs.edit')
            ->assertViewHas('compteurelec');
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

        $response = $this->put(
            route('compteurelecs.update', $compteurelec),
            $data
        );

        $data['id'] = $compteurelec->id;

        $this->assertDatabaseHas('compteurelecs', $data);

        $response->assertRedirect(route('compteurelecs.edit', $compteurelec));
    }

    /**
     * @test
     */
    public function it_deletes_the_compteurelec(): void
    {
        $compteurelec = Compteurelec::factory()->create();

        $response = $this->delete(
            route('compteurelecs.destroy', $compteurelec)
        );

        $response->assertRedirect(route('compteurelecs.index'));

        $this->assertModelMissing($compteurelec);
    }
}
