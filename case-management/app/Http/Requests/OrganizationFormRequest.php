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
                'person_name' => 'string',
            ];
        }

        return [
            'name' => 'required|string|max:255',
            'address_id' => 'required|exists:addresses,id',
            'contact_person_id' => 'required|exists:people,id',
            'created_by' => 'required|string|max:255',
            'updated_by' => 'nullable|string|max:255',
        ];
    }
}
