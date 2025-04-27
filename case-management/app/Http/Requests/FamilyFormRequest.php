<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'family_name' => 'string',
            ];
        }

        return [
            'family_name' => 'required|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
            'zip' => 'nullable|string|max:10',
            'person_ids' => 'nullable|array', // Array of person IDs to associate
            'person_ids.*' => 'exists:persons,id' // Validate each ID exists
        ];
    }
}
