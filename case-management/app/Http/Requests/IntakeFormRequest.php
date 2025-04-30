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
                'parent_name' => 'string',
                'case_summary' => 'string',
                'search' => 'string',
            ];
        }

        return [
            'completed_by_id' => 'required|integer|exists:person,id',
            'parent_name' => 'string|max:50',
            'parent_phone' => 'string|max:20',
            'referral_date' => 'date',
            'referral_contact' => 'string|max:59',
            'case_summary' => 'string',
            'hasSFFCHistory' => 'boolean',
            'do_not_share_list' => 'string',
            'requesting_host_family' => 'boolean',
            'requesting_family_friend' => 'boolean',
            'requesting_resource_friend' => 'boolean',
            'urgency' => 'string|max:10',
            'expected_support_duration' => 'string|max:10',
            'family_preference' => 'string|max:255',
            'known_risks' => 'string',
            'child_protective_services_experience' => 'string',
            'emotional_behavioral_medical_concerns' => 'string',
            'is_a_sffc_fit' => 'boolean',
            'resources_provided' => 'string',
            'intake_status' => 'string|max:2',
            'created_by' => 'string|max:255',
            'updated_by' => 'string|max:255',
        ];
    }
}
