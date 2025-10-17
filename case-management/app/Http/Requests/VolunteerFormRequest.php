<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\IsChurchOrganization;
use App\Models\Volunteer;
use Illuminate\Foundation\Http\FormRequest;

class VolunteerFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'county' => ['nullable', 'string', 'max:255'],
            'church_id' => ['nullable', 'exists:organizations,id', new IsChurchOrganization()],
            'volunteer_status_id' => ['required', 'exists:volunteer_statuses,id'],
        ];

        // 'person_id' is required on create, but not editable on update.
        // It should still be validated.
        return [
            'person_id' => ['required', 'exists:persons,id'],
            ...$rules
        ];
    }

    public function messages(): array
    {
        return [
            'person_id.required' => 'A person must be selected.',
            'person_id.exists' => 'The selected person does not exist.',
            'volunteer_status_id.required' => 'A volunteer status must be selected.',
            'volunteer_status_id.exists' => 'The selected volunteer status does not exist.',
        ];
    }
}
