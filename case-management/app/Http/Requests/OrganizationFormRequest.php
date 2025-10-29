<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'organization_type_id' => 'required|exists:organization_types,id',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
            'zip' => 'nullable|string|max:10',
            'is_referring_agency' => 'nullable|boolean',
            'is_community_partner' => 'nullable|boolean',
            'county' => 'nullable|string|max:50',
            'organization_status_id' => 'nullable|integer',
            //'organization_status_id' => 'nullable|exists:agency_statuses,id',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_title' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|email|max:100',
            'contact_person_phone' => 'nullable|string|max:50',
            'contact_person_mobile' => 'nullable|string|max:50',
            'organization_phone' => 'nullable|string|max:50',
            'person_ids' => 'nullable|array',
            'person_ids.*' => 'exists:persons,id'
        ];
    }
}
