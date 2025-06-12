<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ContactList;

class ContactListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_contact_list_can_be_created()
    {
        $response = $this->post('/contact-lists', [
            'name' => 'Test List',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('contact_lists', ['name' => 'Test List']);
    }
}