<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class PersonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstNameFemale(),
            'middle_name' => fake()->randomLetter(),
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->date(),
            'gender' => 'F',
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address_id' => Address::factory(),
            'can_text_reminder' => fake()->boolean(),
            'can_email_reminder' => fake()->boolean(),
            'ethnicity' => fake()->randomElement(['I', 'A', 'B', 'H', 'M', 'P', 'W', 'T', 'O', 'N', 'U']),
            'created_by' => fake()->lastName(),
            'updated_by' => ""
        ];
    }
}
