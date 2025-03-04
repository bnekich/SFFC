<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\RelationshipType;
use App\Models\Relationship;

class RelationshipFactory extends Factory
{
    public function definition(): array
    {
        return [
            'person_id_1' => Person::factory(), 
            'person_id_2' => Person::factory(), 
            'relationship_type_id' => RelationshipType::factory(), 
            'created_by' => fake()->lastName(), 
            'updated_by' => ""
        ];
    }
}
