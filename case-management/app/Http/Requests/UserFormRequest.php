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
        if ($this->method() === 'GET') {
            return [
                'lastName' => 'string',
                'firstName' => 'string',
                'email' => 'string',
            ];
        }

        return [
            "firstName" => "required|string|max:255",
            "lastName" => "required|string|max:255",
            "email" => [
                'required',
                Rule::email()
                    ->rfcCompliant(strict: true)
            ],
            "phone" => "required|string|max:255",
            "roles" => "required|array|min:1",
            "roles.*" => "exists:roles,id",
        ];
    }

    public function messages()
    {
        return [
            "firstName.required" => "A First Name is required.",
            "lastName.required" => "A Last Name is required.",
            "email.required" => "A valid email address is required.",
        ];
    }
}
