<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            "person_id" => "required",
            "firstName" => "required|string|max:255",
            "lastName" => "required|string|max:255",
            "email" => [
                'required',
                Rule::email()
                    ->rfcCompliant(strict: true)
            ],
            "roles" => "required|array",
            "roles.*" => "exists:roles,name",
        ];
    }

    public function messages()
    {
        return [
            "person_id.required" => "Must be added to the Person table first.",
            "firstName.required" => "A First Name is required.",
            "lastName.required" => "A Last Name is required.",
            "email.required" => "A valid email address is required.",
        ];
    }
}
