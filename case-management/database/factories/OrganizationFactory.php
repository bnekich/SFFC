<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class OrganizationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address_id' => Address::factory(),
            'contact_person_name' => fake()->name(),
            'contact_person_title' => fake()->jobTitle(),
            'contact_person_email' => fake()->unique()->safeEmail(),
            'contact_person_phone' => fake()->phoneNumber(),
            'contact_person_mobile' => fake()->phoneNumber(),
            'notes' => fake()->paragraph(),
            'created_by' => fake()->lastName(),
            'updated_by' => ""
        ];
    }
}
