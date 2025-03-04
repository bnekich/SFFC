<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;
use App\Models\Person;

class OrganizationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(), 
            'address_id' => Address::factory(), 
            'contact_person_id' => Person::factory(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""
        ];
    }
}
