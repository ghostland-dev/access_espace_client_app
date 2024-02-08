<?php

namespace Tests\Feature\Api;

use App\Models\Cpp;
use App\Models\User;
use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCppsTest extends TestCase
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
    public function it_gets_contact_cpps(): void
    {
        $contact = Contact::factory()->create();
        $cpps = Cpp::factory()
            ->count(2)
            ->create([
                'contact_id' => $contact->id,
            ]);

        $response = $this->getJson(route('api.contacts.cpps.index', $contact));

        $response->assertOk()->assertSee($cpps[0]->fichier);
    }

    /**
     * @test
     */
    public function it_stores_the_contact_cpps(): void
    {
        $contact = Contact::factory()->create();
        $data = Cpp::factory()
            ->make([
                'contact_id' => $contact->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.contacts.cpps.store', $contact),
            $data
        );

        $this->assertDatabaseHas('cpps', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $cpp = Cpp::latest('id')->first();

        $this->assertEquals($contact->id, $cpp->contact_id);
    }
}
