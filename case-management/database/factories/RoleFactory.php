<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => 'Guest'];
    }
}
