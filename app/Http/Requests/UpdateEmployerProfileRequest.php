<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:100'],
            'company_website' => ['nullable', 'url', 'max:255'],
            'company_description' => ['nullable', 'string', 'max:2000'],
            'tax_id' => ['nullable', 'string', 'max:100'],
            'company_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' => 'Company name is required',
            'industry.required' => 'Industry is required',
            'company_website.url' => 'Please enter a valid website URL',
            'company_description.max' => 'Company description cannot exceed 2000 characters',
            'company_logo.image' => 'The file must be an image',
            'company_logo.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp',
            'company_logo.max' => 'The image may not be greater than 5MB',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
        ];
    }
}
