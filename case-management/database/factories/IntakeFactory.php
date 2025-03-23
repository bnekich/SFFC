<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intake>
 */
class IntakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'completed_by_id' => 1,
            'parent_name' => fake()->unique()->firstName() . ' ' . fake()->unique()->lastName(),
            'case_summary' => fake()->paragraph(),
            'created_by' => "system",
            'updated_by' => "system",
        ];
    }
}
