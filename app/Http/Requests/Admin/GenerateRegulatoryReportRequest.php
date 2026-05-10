<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GenerateRegulatoryReportRequest extends FormRequest
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
            'report_type' => ['required', 'string', 'max:255'],
            'date_range_start' => ['required', 'date'],
            'date_range_end' => ['required', 'date', 'after_or_equal:date_range_start'],
        ];
    }
}
