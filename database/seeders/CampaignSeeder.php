<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\ContactList;
use Illuminate\Support\Carbon;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $lists = ContactList::all();

        Campaign::factory()->count(5)->create([
            'contact_list_id' => $lists->random()->id,
        ])->each(function ($campaign) {
            $campaign->update([
                'start_date' => Carbon::now()->addDays(rand(1, 5)),
                'end_date' => Carbon::now()->addDays(rand(6, 10)),
            ]);
        });
    }
}