<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\ContactList;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), 
            'subject' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'contact_list_id' => ContactList::factory(),
        ];
    }
}