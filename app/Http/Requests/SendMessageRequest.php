<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
                'min:1',
                'max:1000',
                'regex:/^[\s\S]*\S[\s\S]*$/', // Ensure not just whitespace
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Message cannot be empty.',
            'message.string' => 'Message must be text.',
            'message.min' => 'Message must be at least 1 character.',
            'message.max' => 'Message cannot exceed 1000 characters.',
            'message.regex' => 'Message cannot contain only whitespace.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        
        if (is_array($validated) && isset($validated['message'])) {
            $validated['message'] = trim($validated['message']);
        }
        
        return $validated;
    }
}
