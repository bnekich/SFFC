<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PersonType;

class PersonTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => "Person Type"
        ];
    }
}
