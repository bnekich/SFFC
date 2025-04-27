<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseModelFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'case_identifier' => 'string',
                'case_description' => 'string',
            ];
        }

        if ($this->method() === 'PUT') {
            return [
                'case_description' => 'nullable|string',
                'client_family_id' => 'nullable|exists:families,id',
                'host_family_id' => 'nullable|exists:families,id',
                'assigned_staff_id' => 'nullable|exists:persons,id',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'status' => 'required|string',
            ];
        }

        return [
            'case_identifier' => 'required|unique:cases|max:255',
            'case_description' => 'nullable|string',
            'client_family_id' => 'nullable|exists:families,id',
            'host_family_id' => 'nullable|exists:families,id',
            'assigned_staff_id' => 'nullable|exists:persons,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::error('Validation failed', $validator->errors()->toArray());
        parent::failedValidation($validator);
    }
}
