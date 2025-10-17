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
            'person_id' => $this->faker->numberBetween(1, 99),
            'county' => $this->faker->randomElement(['Dodge', 'Jefferson']),
            'church_id' => 10,
            'volunteer_status_id' => $this->faker->numberBetween(1, 4),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
