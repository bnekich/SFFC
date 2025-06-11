<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IntakeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'completed_by_id' => 1,
            'parent_name' => fake()->unique()->firstName() . ' ' . fake()->unique()->lastName(),
            'parent_phone' => fake()->phoneNumber(),
            'referral_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'referral_contact' => fake()->unique()->firstName() . ' ' . fake()->unique()->lastName(),
            'case_summary' => fake()->paragraph(),
            'hasSFFCHistory' => fake()->boolean(0.5),
            'do_not_share_list' => '',
            'requesting_host_family' => fake()->boolean(0.5),
            'requesting_family_friend' => fake()->boolean(0.5),
            'requesting_resource_friend' => fake()->boolean(0.5),
            'urgency' => '',
            'expected_support_duration' => '',
            'family_preference' => '',
            'known_risks' => '',
            'child_protective_services_experience' => '',
            'emotional_behavioral_medical_concerns' => '',
            'is_a_sffc_fit' => fake()->boolean(0.5),
            'resources_provided' => '',
            'created_by' => 1,
            'updated_by' => 1,
            'intake_status' => fake()->randomElement(['F', 'S', 'T', 'I', 'C', 'X', 'O']),

        ];
    }
}
