<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Site;
use App\Models\Contact;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteContactsTest extends TestCase
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
    public function it_gets_site_contacts(): void
    {
        $site = Site::factory()->create();
        $contacts = Contact::factory()
            ->count(2)
            ->create([
                'site_id' => $site->id,
            ]);

        $response = $this->getJson(route('api.sites.contacts.index', $site));

        $response->assertOk()->assertSee($contacts[0]->civilite);
    }

    /**
     * @test
     */
    public function it_stores_the_site_contacts(): void
    {
        $site = Site::factory()->create();
        $data = Contact::factory()
            ->make([
                'site_id' => $site->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sites.contacts.store', $site),
            $data
        );

        $this->assertDatabaseHas('contacts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $contact = Contact::latest('id')->first();

        $this->assertEquals($site->id, $contact->site_id);
    }
}
