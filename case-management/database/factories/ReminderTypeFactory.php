<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ReminderType;

class ReminderTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => "Reminder type"
        ];
    }
}
