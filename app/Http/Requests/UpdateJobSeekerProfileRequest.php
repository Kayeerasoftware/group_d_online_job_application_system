<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobSeekerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:100'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'skills' => ['nullable', 'string'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }
}
