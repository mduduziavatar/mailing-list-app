<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\ContactList;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $lists = ContactList::all();

        Contact::factory()->count(20)->create()->each(function ($contact) use ($lists) {
            $contact->contactLists()->attach(
                $lists->random(1)->pluck('id')->toArray()
            );
        });
    }
}