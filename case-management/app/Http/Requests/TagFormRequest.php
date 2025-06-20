<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagFormRequest extends FormRequest
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
            ];
        }

        return [
            'name' => 'required|string|max:255|unique:tags,name',
        ];
    }
}
