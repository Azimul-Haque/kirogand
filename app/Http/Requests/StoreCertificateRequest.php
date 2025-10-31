<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only allow authenticated users with appropriate permissions
        return auth()->check(); 
    }

    public function rules(): array
    {
        // 1. Get the requested certificate type
        $type = $this->input('certificate_type');

        // 2. Ensure the type is present and configuration exists
        if (!$type || !config()->has("certificate_schemas.{$type}")) {
            // Return base rules or throw an error if no type is selected
            return ['certificate_type' => ['required', 'string']];
        }

        // 3. Load the schema configuration
        $schema = config("certificate_schemas.{$type}");

        // 4. Build the validation rules array dynamically
        $rules = [
            // Standard rule to ensure type selection is valid
            'certificate_type' => ['required', 'string', 'in:' . implode(',', array_keys(config('certificate_schemas')))], 
            'recipient_user_id' => ['required', 'exists:users,id'], // Standard rule for recipient
        ];

        foreach ($schema['fields'] as $field) {
            // Use the 'name' as the form field key and 'rules' from the schema
            $rules[$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
