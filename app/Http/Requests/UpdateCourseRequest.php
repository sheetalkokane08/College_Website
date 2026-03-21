<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', Rule::unique('courses')->ignore($this->course), 'max:50'],
            'description' => 'nullable|string|max:1000',
            'credits' => 'required|integer|min:1|max:12',
            'department_id' => 'required|exists:departments,id',
            'faculty_id' => 'required|exists:faculty,id',
        ];
    }
}
