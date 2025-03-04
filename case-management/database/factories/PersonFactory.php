<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\PersonType;

class PersonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstNameMale(), 
            'middle_name' => fake()->randomLetter(), 
            'last_name' => fake()->lastName(), 
            'date_of_birth' => fake()->date(), 
            'gender' => fake()->gender('male'), 
            'email' => fake()->unique()->safeEmail(), 
            'phone' => fake()->phoneNumber(), 
            'can_text_reminder' => fake()->boolean(), 
            'can_email_reminder' => fake()->boolean(), 
            'person_type' => PersonType::factory(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""
        ];
    }
}
