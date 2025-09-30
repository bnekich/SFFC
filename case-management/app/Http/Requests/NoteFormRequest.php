<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->method() === 'GET') {
            return [
                'title' => 'string',
                'note' => 'string',
            ];
        }

        return [
            'title' => 'required|string|max:255',
            'note' => 'required|string',
            'comments' => 'nullable|string',
            'privacy_id' => 'nullable|integer',
            'note_status_id' => 'nullable|integer',
            'approved' => 'nullable|boolean',
            'cases' => 'nullable|array',
            'cases.*' => 'integer|exists:cases,id',
            'volunteers' => 'nullable|array',
            'volunteers.*' => 'integer|exists:volunteers,person_id',
        ];
    }
}
