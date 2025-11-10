<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    public function definition(): array
    {

        return [
            'family_name' => fake()->lastName(),
            'address_id' => 1,
            // 'status_id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
