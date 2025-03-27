<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address_line_1' => 'string|nullable',
            'address_line_2' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|size:2|nullable',
            'zip' => 'string|max:10|nullable',
            'created_by' => 'required|string|max:255',
            'updated_by' => 'required|string|max:255',
        ];
    }
}
