<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseNoteFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'case_id' => 'string',
            ];
        }

        return [
            'case_id' => 'required|exists:cases,id',
            'subject' => 'required|string|max:255',
            'note' => 'required|string',
            'privacy_level' => 'nullable|string',
            'status' => 'nullable|string',
            'is_approved' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:tags,id',
        ];
    }
}
