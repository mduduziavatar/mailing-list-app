<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ContactList;
use App\Models\Contact;
use App\Models\Campaign;

class MailingListFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_all_contact_lists()
    {
        $lists = ContactList::factory()->count(2)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        foreach ($lists as $list) {
            $response->assertSee($list->name);
        }
    }

    public function test_contact_list_can_be_deleted()
    {
        $list = ContactList::factory()->create();

        $response = $this->delete('/contact-lists/' . $list->id);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('contact_lists', ['id' => $list->id]);
    }

    public function test_contact_can_be_added_to_list()
    {
        $list = ContactList::factory()->create();

        $response = $this->post('/contact-lists/' . $list->id . '/add-contact', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contacts', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('contact_contact_list', [
            'contact_list_id' => $list->id
        ]);
    }

    public function test_campaign_can_be_created()
    {
        $list = ContactList::factory()->create();

        $response = $this->post('/campaigns', [
            'subject' => 'New Campaign',
            'message' => 'Hello!',
            'contact_list_id' => $list->id
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('campaigns', [
            'subject' => 'New Campaign',
            'contact_list_id' => $list->id
        ]);
    }
}
