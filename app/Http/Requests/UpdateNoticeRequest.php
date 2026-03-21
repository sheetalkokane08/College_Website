<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoticeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $notice = $this->route('notice');
        // only the faculty who created it may update or delete it
        return auth()->check() && auth()->user()->isFaculty() && $notice && $notice->faculty_id === auth()->user()->facultyRecord?->id;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ];
    }
}
