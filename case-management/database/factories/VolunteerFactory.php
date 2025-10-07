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
            'person_id' => 1,
            'county' => 'Dodge',
            'church_id' => 1,
            'volunteer_status_id' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
