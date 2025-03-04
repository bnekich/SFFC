<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => fake()->paragraph()
        ];
    }
}
