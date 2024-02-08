<?php

namespace Tests\Feature\Controllers;

use App\Models\Cpp;
use App\Models\User;

use App\Models\Contact;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CppControllerTest extends TestCase
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
    public function it_displays_index_view_with_cpps(): void
    {
        $cpps = Cpp::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('cpps.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.cpps.index')
            ->assertViewHas('cpps');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_cpp(): void
    {
        $response = $this->get(route('cpps.create'));

        $response->assertOk()->assertViewIs('app.cpps.create');
    }

    /**
     * @test
     */
    public function it_stores_the_cpp(): void
    {
        $data = Cpp::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('cpps.store'), $data);

        $this->assertDatabaseHas('cpps', $data);

        $cpp = Cpp::latest('id')->first();

        $response->assertRedirect(route('cpps.edit', $cpp));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_cpp(): void
    {
        $cpp = Cpp::factory()->create();

        $response = $this->get(route('cpps.show', $cpp));

        $response
            ->assertOk()
            ->assertViewIs('app.cpps.show')
            ->assertViewHas('cpp');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_cpp(): void
    {
        $cpp = Cpp::factory()->create();

        $response = $this->get(route('cpps.edit', $cpp));

        $response
            ->assertOk()
            ->assertViewIs('app.cpps.edit')
            ->assertViewHas('cpp');
    }

    /**
     * @test
     */
    public function it_updates_the_cpp(): void
    {
        $cpp = Cpp::factory()->create();

        $contact = Contact::factory()->create();

        $data = [
            'fichier' => $this->faker->text(255),
            'signe' => $this->faker->boolean(),
            'contact_id' => $contact->id,
        ];

        $response = $this->put(route('cpps.update', $cpp), $data);

        $data['id'] = $cpp->id;

        $this->assertDatabaseHas('cpps', $data);

        $response->assertRedirect(route('cpps.edit', $cpp));
    }

    /**
     * @test
     */
    public function it_deletes_the_cpp(): void
    {
        $cpp = Cpp::factory()->create();

        $response = $this->delete(route('cpps.destroy', $cpp));

        $response->assertRedirect(route('cpps.index'));

        $this->assertModelMissing($cpp);
    }
}
