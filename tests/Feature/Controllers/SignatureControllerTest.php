<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Signature;

use App\Models\Contact;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignatureControllerTest extends TestCase
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
    public function it_displays_index_view_with_signatures(): void
    {
        $signatures = Signature::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('signatures.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.signatures.index')
            ->assertViewHas('signatures');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_signature(): void
    {
        $response = $this->get(route('signatures.create'));

        $response->assertOk()->assertViewIs('app.signatures.create');
    }

    /**
     * @test
     */
    public function it_stores_the_signature(): void
    {
        $data = Signature::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('signatures.store'), $data);

        $this->assertDatabaseHas('signatures', $data);

        $signature = Signature::latest('id')->first();

        $response->assertRedirect(route('signatures.edit', $signature));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_signature(): void
    {
        $signature = Signature::factory()->create();

        $response = $this->get(route('signatures.show', $signature));

        $response
            ->assertOk()
            ->assertViewIs('app.signatures.show')
            ->assertViewHas('signature');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_signature(): void
    {
        $signature = Signature::factory()->create();

        $response = $this->get(route('signatures.edit', $signature));

        $response
            ->assertOk()
            ->assertViewIs('app.signatures.edit')
            ->assertViewHas('signature');
    }

    /**
     * @test
     */
    public function it_updates_the_signature(): void
    {
        $signature = Signature::factory()->create();

        $contact = Contact::factory()->create();

        $data = [
            'fichier' => $this->faker->text(255),
            'signe' => $this->faker->boolean(),
            'contact_id' => $contact->id,
        ];

        $response = $this->put(route('signatures.update', $signature), $data);

        $data['id'] = $signature->id;

        $this->assertDatabaseHas('signatures', $data);

        $response->assertRedirect(route('signatures.edit', $signature));
    }

    /**
     * @test
     */
    public function it_deletes_the_signature(): void
    {
        $signature = Signature::factory()->create();

        $response = $this->delete(route('signatures.destroy', $signature));

        $response->assertRedirect(route('signatures.index'));

        $this->assertModelMissing($signature);
    }
}
