<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Contact;
use App\Models\Signature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactSignaturesTest extends TestCase
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
    public function it_gets_contact_signatures(): void
    {
        $contact = Contact::factory()->create();
        $signatures = Signature::factory()
            ->count(2)
            ->create([
                'contact_id' => $contact->id,
            ]);

        $response = $this->getJson(
            route('api.contacts.signatures.index', $contact)
        );

        $response->assertOk()->assertSee($signatures[0]->fichier);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_signatures(): void
    {
        $contact = Contact::factory()->create();
        $data = Signature::factory()
            ->make([
                'contact_id' => $contact->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contacts.signatures.store', $contact),
            $data
        );

        $this->assertDatabaseHas('signatures', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $signature = Signature::latest('id')->first();

        $this->assertEquals($contact->id, $signature->contact_id);
    }
}
