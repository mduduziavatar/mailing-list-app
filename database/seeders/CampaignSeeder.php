<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\ContactList;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $list = ContactList::first(); 
        if (!$list) {
            echo "❗ No Contact List found. Please create a list first.";
            return;
        }

        Campaign::create([
            'subject' => '🎉 Welcome to our newsletter',
            'message' => 'Thanks for joining our list! Stay tuned for updates.',
            'contact_list_id' => $list->id,
        ]);

        Campaign::create([
            'subject' => '🔥 Limited Time Offer',
            'message' => 'Use code SPRING10 for 10% off your next purchase.',
            'contact_list_id' => $list->id,
        ]);
    }
}