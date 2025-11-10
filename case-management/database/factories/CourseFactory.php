<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'instructor_id' => fake()->numberBetween(1, 10),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
