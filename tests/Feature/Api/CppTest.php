<?php

namespace Tests\Feature\Api;

use App\Models\Cpp;
use App\Models\User;

use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CppTest extends TestCase
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
    public function it_gets_cpps_list(): void
    {
        $cpps = Cpp::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.cpps.index'));

        $response->assertOk()->assertSee($cpps[0]->fichier);
    }

    /**
     * @test
     */
    public function it_stores_the_cpp(): void
    {
        $data = Cpp::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.cpps.store'), $data);

        $this->assertDatabaseHas('cpps', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.cpps.update', $cpp), $data);

        $data['id'] = $cpp->id;

        $this->assertDatabaseHas('cpps', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_cpp(): void
    {
        $cpp = Cpp::factory()->create();

        $response = $this->deleteJson(route('api.cpps.destroy', $cpp));

        $this->assertModelMissing($cpp);

        $response->assertNoContent();
    }
}
