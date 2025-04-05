<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest
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
                'person_name' => 'string',
            ];
        }

        return [
            'title' => 'required|string|max:255',
            'instructor_id' => 'required|exists:persons,id',
        ];
    }
}
