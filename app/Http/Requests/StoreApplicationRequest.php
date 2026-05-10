<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_id' => ['required', 'exists:jobs,id'],
            'cover_letter' => ['required', 'string', 'min:50'],
            'cv_path' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ];
    }
}
