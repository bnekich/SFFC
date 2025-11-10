<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonsOrganizationsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'person_id' => fake()->numberBetween(1, 99),
            'organization_id' => fake()->numberBetween(1, 14),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
