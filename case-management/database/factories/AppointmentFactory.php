<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\CaseModel;
use App\Models\Status;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'case_id' => CaseModel::factory(), 
            'title' => fake()->title(),
            'description' => fake()->sentence(),
            'start' => now(),
            'end' => now(), 
            'location' => fake()->address(), 
            'send_reminders' => false, 
            'status_id' => Status::factory(), 
            'created_by' => fake()->lastName(),
            'updated_by' => "",
        ];
    }
}
