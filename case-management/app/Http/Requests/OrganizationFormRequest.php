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
            'address_id' => 'nullable|exists:addresses,id',
            'contact_person_name' => 'nullable|exists:people,id',
            'contact_person_title' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|email|max:255',
            'contact_person_phone' => 'nullable|string|max:255',
            'contact_person_mobile' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'person_ids' => 'nullable|array', // Array of person IDs to associate
            'person_ids.*' => 'exists:persons,id' // Validate each ID exists
        ];
    }
}
