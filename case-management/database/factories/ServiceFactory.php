<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => "Counselling Service", 
            'description' => "Family counselling service", 
            'provider' => "Service provider", 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""];
    }
}
