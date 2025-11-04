<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IntakeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'completed_by_id' => 1,
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile_phone' => fake()->phoneNumber(),
            'ethnicity' => fake()->randomElement(['I', 'A', 'B', 'H', 'M', 'P', 'W', 'T', 'O', 'N', 'U']),
            'gender' => fake()->randomElement(['M', 'F']),
            'primary_language_spoken' => fake()->randomElement(['English', 'French', 'Spanish', 'Other']),
            'date_of_birth' => fake()->date(),
            'is_homeless' => fake()->boolean(0.5),
            'address_id' => 1,
            'email' => fake()->unique()->safeEmail(),
            'mobile_phone' => fake()->phoneNumber(),
            'other_phone' => fake()->phoneNumber(),
            'organization_id' => fake()->numberBetween(1, 9),
            'organization_type_id' => fake()->numberBetween(1, 34),
            'referral_organization' => fake()->company(),
            'referral_organization_phone' => fake()->phoneNumber(),
            'parent_declines_sffc_support' => false,
            'parent_agrees_to_sffc_support' => fake()->boolean(0.5),
            'parent_wants_more_info' => false,
            'urgency' => fake()->randomElement(['Urgent', 'In a Week', 'In a Month']),
            'requesting_host_family' => fake()->boolean(0.5),
            'requesting_family_friend' => fake()->boolean(0.5),
            'reason_for_assistance' => fake()->paragraph(),
            'number_of_children' => fake()->numberBetween(0, 10),
            'can_text_reminder' => fake()->boolean(0.5),
            'can_email_reminder' => fake()->boolean(0.5),
            'intake_status_id' => fake()->numberBetween(1, 8),
            'created_by' => 1,
            'updated_by' => 1
        ];
    }
}
