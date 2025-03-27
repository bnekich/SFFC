<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleFormRequest extends FormRequest
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
        'role_type' => 'string',
      ];
    }

    return [
      'name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('roles', 'name')->ignore($this->route('role')),
      ],
      'permissions' => 'nullable|array',
      'role_type' => 'nullable|string|max:255',
      'permissions.*' => 'exists:permissions,name',
    ];
  }
}
