<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactList;

class ContactListSeeder extends Seeder
{
    public function run(): void
    {
        ContactList::factory()->count(10)->create();
    }
}