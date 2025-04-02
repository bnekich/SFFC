<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() === 'GET') {
            return [
                'first_name' => 'string',
                'last_name' => 'string',
            ];
        }

        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|string|max:2',
            'email' => 'nullable|email|max:255',
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
        ];
    }
}
