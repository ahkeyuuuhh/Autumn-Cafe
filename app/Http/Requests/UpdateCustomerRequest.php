<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated admin users can update customers
        return \Illuminate\Support\Facades\Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customerId = $this->route('customer') ? $this->route('customer')->id : null;
        
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-\']+$/', // Only letters, spaces, dots, hyphens, apostrophes
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:customers,email,' . $customerId,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Valid email format
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^(\+63|0)[0-9]{10}$/', // Philippine phone format
                'unique:customers,phone,' . $customerId,
            ],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'Name can only contain letters, spaces, dots, hyphens, and apostrophes.',
            'email.regex' => 'Please provide a valid email address.',
            'email.email' => 'Please provide a valid email address.',
            'phone.regex' => 'Phone number must be a valid Philippine number (e.g., +639123456789 or 09123456789).',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize inputs before validation
        $this->merge([
            'name' => $this->sanitizeInput($this->name),
            'email' => $this->sanitizeEmail($this->email),
            'phone' => $this->sanitizePhone($this->phone),
        ]);
    }

    /**
     * Sanitize text input to prevent XSS
     */
    private function sanitizeInput(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }
        
        // Remove any HTML/PHP tags
        $sanitized = strip_tags($input);
        
        // Remove any script tags and their content
        $sanitized = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $sanitized);
        
        // Trim whitespace
        $sanitized = trim($sanitized);
        
        return $sanitized;
    }

    /**
     * Sanitize email input
     */
    private function sanitizeEmail(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }
        
        // Remove tags and trim
        $sanitized = strip_tags(trim($input));
        
        // Convert to lowercase
        $sanitized = strtolower($sanitized);
        
        return $sanitized;
    }

    /**
     * Sanitize phone input
     */
    private function sanitizePhone(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }
        
        // Remove any non-numeric characters except +
        $sanitized = preg_replace('/[^0-9+]/', '', $input);
        
        return $sanitized;
    }
}
