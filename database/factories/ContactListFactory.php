<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactListFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Test List ' . $this->faker->unique()->word,
        ];
    }
}