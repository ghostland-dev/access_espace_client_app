<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Signature;

use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignatureTest extends TestCase
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
    public function it_gets_signatures_list(): void
    {
        $signatures = Signature::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.signatures.index'));

        $response->assertOk()->assertSee($signatures[0]->fichier);
    }

    /**
     * @test
     */
    public function it_stores_the_signature(): void
    {
        $data = Signature::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.signatures.store'), $data);

        $this->assertDatabaseHas('signatures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.signatures.update', $signature),
            $data
        );

        $data['id'] = $signature->id;

        $this->assertDatabaseHas('signatures', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_signature(): void
    {
        $signature = Signature::factory()->create();

        $response = $this->deleteJson(
            route('api.signatures.destroy', $signature)
        );

        $this->assertModelMissing($signature);

        $response->assertNoContent();
    }
}
