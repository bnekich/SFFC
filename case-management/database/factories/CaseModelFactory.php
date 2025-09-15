<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CaseModel;

class CaseModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'case_identifier' => fake()->unique()->lastName() . fake()->unique()->randomNumber(5),
            'case_description' => fake()->paragraph(),
            'client_family_id' => null,
            'host_family_id' => null,
            'assigned_staff_id' => fake()->numberBetween(1, 9),
            'start_date' => fake()->date(),
            'end_date' => null,
            'status' => fake()->randomElement(['O', 'C', 'H', 'X']),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
