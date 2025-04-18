<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseNoteFormRequest extends FormRequest
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
        if ($this->method() === 'GET') {
            return [
                'case_id' => 'string',
            ];
        }

        return [
            'case_id' => 'required|exists:cases,id',
            'subject' => 'required|string|max:255',
            'note' => 'required|string',
            'privacy_level' => 'nullable|in:public,private',
            'status' => 'nullable|in:active,inactive',
            'is_approved' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50', // Each tag should be a string with a max length of 50
        ];
    }
}
