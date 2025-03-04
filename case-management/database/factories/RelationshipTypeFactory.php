<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RelationshipType;

class RelationshipTypeFactory extends Factory
{
    public function definition(): array
    {
        return ['name'=> fake()->name()];
    }
}
