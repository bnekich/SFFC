<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrganizationType;

class OrganizationTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Test Organization Type'
        ];
    }
}
