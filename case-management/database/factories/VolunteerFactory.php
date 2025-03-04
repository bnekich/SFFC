<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'training_status' => Status::factory(),
            'availability' => Status::factory(), 
            'assignment_date' => fake()->now(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""
        ];
    }
}
