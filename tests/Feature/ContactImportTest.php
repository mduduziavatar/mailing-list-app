<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\ContactList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_contacts_can_be_imported_from_csv()
    {
        Storage::fake('local');

        $list = ContactList::factory()->create();

        // Simulate a valid CSV file with headers
        $csvContent = "full_name,email\nJane Doe,jane@example.com";

        // Use Laravel's fake file with content
        $file = UploadedFile::fake()->createWithContent('contacts.csv', $csvContent);

        $response = $this->post("/contact-lists/{$list->id}/import", [
            'file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'email' => 'jane@example.com',
            'full_name' => 'Jane Doe',
        ]);
    }
}