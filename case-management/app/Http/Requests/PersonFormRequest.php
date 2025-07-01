<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'first_name' => 'string',
                'last_name' => 'string',
            ];
        }

        $person = $this->route('person');

        $rules = [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|string|max:2',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('persons', 'email')->ignore($person?->id),
            ],
            'phone' => 'nullable|string|max:255',
            'can_text_reminder' => 'boolean',
            'can_email_reminder' => 'boolean',
            'auth_roles' => 'nullable|array',
            'auth_roles.*' => 'exists:roles,id',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
            'zip' => 'nullable|string|max:10',
            'family_ids' => 'nullable|array',
            'org_ids' => 'nullable|array',
            'ethnicity' => 'string|max:2',
            'isSystemUser' => 'sometimes|boolean'

        ];

        if ($this->input('isSystemUser')) {
            $userToIgnore = null;
            if ($person && $person->email) {
                // Find a user with the same email to ignore during validation on update.
                $userToIgnore = \App\Models\User::where('email', $person->email)->first();
            }

            // If it's a system user, email is required and must be unique in the 'users' table.
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userToIgnore?->id),
                Rule::unique('persons', 'email')->ignore($person?->id),
            ];

            // Roles are also required for a system user.
            $rules['auth_roles'] = 'required|array|min:1';
            $rules['auth_roles.*'] = 'exists:roles,id';
        }
        return $rules;
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::error('Validation failed', $validator->errors()->toArray());
        parent::failedValidation($validator);
    }
}
