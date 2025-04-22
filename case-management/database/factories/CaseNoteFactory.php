<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaseNote>
 */
class CaseNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'case_id' => $this->faker->numberBetween(1, 100),
            'subject' => $this->faker->sentence,
            'note' => $this->faker->paragraph,
            'privacy_level' => $this->faker->randomElement(['public', 'private']),
            'status' => $this->faker->randomElement(['open', 'closed']),
            'is_approved' => $this->faker->boolean,
            'created_by' => $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
