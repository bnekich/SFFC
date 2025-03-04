<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;
use App\Models\Status;
use App\Models\Family;

class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_name' => fake()->lastName(), 
            'address_id' => Address::factory(), 
            'status_id' => Status::factory(), 
            'created_by' => fake()->lastname(), 
            'updated_by' => ""
        ];
       }
}
