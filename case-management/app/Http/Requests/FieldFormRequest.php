<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "field_name" => "required|string|max:100",
            "field_type" => "required|string|max:50",
            "label" => "required|string|max:255",
            "validation_rules" => "required|string|max:255",
        ];
    }

    public function messages()
    {
        return [
            "field_name.required" => "A Field Name is required.",
            "field_type.required" => "A Field Type is required.",
            "label.required" => "A Label is required.",
            "validation_rules.required" => "validation rules are required.",
        ];
    }
}
