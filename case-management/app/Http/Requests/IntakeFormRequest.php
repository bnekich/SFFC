<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntakeFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'name' => 'string',
            ];
        }

        return [
            'address_line_1' => 'string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'can_text_reminder' => 'nullable|boolean',
            'can_email_reminder' => 'nullable|boolean',
            'child_protective_services_experience' => 'nullable|string',
            'city' => 'string|max:255',
            'completed_by_id' => 'nullable|exists:users,id',
            'created_by' => 'nullable|exists:users,id',
            'date_of_birth' => 'date',
            'do_not_share_list' => 'string',
            'email' => 'nullable|email|max:255',
            'emotional_behavioral_medical_concerns' => 'string',
            'ethnicity' => 'string|max:2',
            'expected_support_duration' => 'string|max:10',
            'family_preference' => 'string|max:255',
            'first_name' => 'string|max:255',
            'gender' => 'string|max:1',
            'hasSFFCHistory' => 'boolean',
            'intake_status_id' => 'nullable|exists:intake_statuses,id',
            'is_a_sffc_fit' => 'boolean',
            'is_homeless' => 'nullable|boolean',
            'known_risks' => 'string',
            'last_name' => 'string|max:255',
            'mobile_phone' => 'string|max:20',
            'other_phone' => 'nullable|string|max:255',
            'number_of_children' => 'integer',
            'organization_id' => 'nullable|exists:organizations,id',
            'organization_type_id' => 'nullable|exists:organization_types,id',
            'other_phone' => 'nullable|string|max:20',
            'parent_declines_sffc_support' => 'boolean',
            'parent_agrees_to_sffc_support' => 'boolean',
            'parent_wants_more_info' => 'boolean',
            'primary_language_spoken' => 'string|max:255',
            'reason_for_assistance' => 'string',
            'referral_contact' => 'nullable|string|max:255',
            'referral_organization' => 'nullable|string|max:255',
            'referral_organization_email' => 'nullable|email|max:255',
            'referral_organization_phone' => 'nullable|string|max:255',
            'requested_service' => ['required', 'in:friend,host'],
            'requesting_family_friend' => 'boolean',
            'requesting_host_family' => 'boolean',
            'requesting_resource_friend' => 'boolean',
            'resources_provided' => 'string',
            'state' => 'nullable|string|max:2',
            'updated_by' => 'nullable|exists:users,id',
            'urgency' => 'nullable|string|max:25',
            'zip' => 'nullable|string|max:10',
            'sffc_choice' => ['required', 'in:declines,agrees,more_info'],

        ];
    }
}
