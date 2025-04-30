<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //return auth()->user()->hasPermissionTo('view documents');
    }

    public function rules(): array
    {
        return [
            'query' => 'nullable|string|max:255',
        ];
    }
}
