<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('departments')->ignore($this->department), 'max:255'],
            'code' => ['required', 'string', Rule::unique('departments')->ignore($this->department), 'max:50'],
            'description' => 'nullable|string|max:1000',
        ];
    }
}
