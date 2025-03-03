<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_line_1' => fake()->address_line_1(),
            'address_line_2' => fake()->address_line_2(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'zip' => fake()->zip(),            
        ];
    }
}
