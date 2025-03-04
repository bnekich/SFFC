<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Family;
use App\Models\Person;
use App\Models\Status;

class CaseModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'case_identifier' => "CASE001AB",
            'case_description' => fake()->paragraph(),
            'client_family_id' => Family::factory(), 
            'host_family_id' => Family::factory(), 
            'assigned_staff_id' => Person::factory(), 
            'start_date' => fake()->now(),
            'end_date' => fake()->now(),
            'status_id' => Status::factory(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => "",
        ];
    }
}
