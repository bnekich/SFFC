<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\Course;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->word(), 
            'instructor_id' => Person::factory()
    ];
    }
}
