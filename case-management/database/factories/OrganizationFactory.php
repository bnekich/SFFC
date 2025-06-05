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
            'organization_type_id' => fake()->numberBetween(1, 5), // Assuming you have 5 organization types
            'contact_person_name' => fake()->name(),
            'contact_person_title' => fake()->jobTitle(),
            'contact_person_email' => fake()->unique()->safeEmail(),
            'contact_person_phone' => fake()->phoneNumber(),
            'contact_person_mobile' => fake()->phoneNumber(),
            'notes' => fake()->paragraph(),
            'created_by' => $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10)
        ];
    }
}
