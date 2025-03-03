<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'case_id' => 1,
            'description' => fake()->description(),
            'start' => now(),
            'end' => now(), 
            'location' => fake()->location(), 
            'send_reminders' => false, 
            'status_id' => Status::factory(), 
            'created_by' => fake()->created_by(), 
            'updated_by' => fake()->updated_by()
        ];
    }
}
