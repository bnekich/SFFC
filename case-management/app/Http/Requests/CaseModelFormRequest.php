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

        return [
            'case_identifier' => 'required|unique:cases|max:255',
            'case_description' => 'nullable|string',
            'client_family_id' => 'nullable|exists:families,id',
            'host_family_id' => 'nullable|exists:families,id',
            'assigned_staff_id' => 'nullable|exists:persons,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status_id' => 'required|exists:statuses,id',
            'created_by' => 'required|string',
            'updated_by' => 'required|string'
        ];
    }
}
