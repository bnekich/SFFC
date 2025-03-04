<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\Person;
use App\Models\ReminderType;
use App\Models\Status;
use App\Models\Reminder;

class ReminderFactory extends Factory
{

    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(), 
            'for_person_id' => Person::factory(), 
            'reminder_type' => ReminderType::factory(), 
            'reminder_time' => DateTime::now(), 
            'status' => Status::factory(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""
        ];
    }
}
