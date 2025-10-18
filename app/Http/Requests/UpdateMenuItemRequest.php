<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only authenticated admin users can update menu items
        return session()->has('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[a-zA-Z0-9\s\-\&\.\,\']+$/', // Alphanumeric with basic punctuation
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                'regex:/^\d+(\.\d{1,2})?$/', // Valid decimal format
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[a-zA-Z0-9\s\-\&\.\,\'\"!?()]+$/', // Safe characters only
            ],
            'category' => [
                'nullable',
                'string',
                'max:100',
                'in:Coffee,Tea,Pastries,Snacks,Beverages,Desserts,Other', // Whitelist categories
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:9999',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048', // 2MB max
                'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
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
            'name.regex' => 'The name can only contain letters, numbers, spaces, and basic punctuation (-, &, ., \', ,).',
            'price.regex' => 'The price must be a valid decimal number with up to 2 decimal places.',
            'description.regex' => 'The description contains invalid characters.',
            'category.in' => 'Please select a valid category from the list.',
            'image.dimensions' => 'The image must be at least 100x100 pixels and not exceed 4000x4000 pixels.',
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
            'description' => $this->sanitizeInput($this->description),
            'category' => $this->sanitizeInput($this->category),
            'price' => $this->sanitizeNumeric($this->price),
            'stock' => $this->sanitizeNumeric($this->stock),
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
     * Sanitize numeric input
     */
    private function sanitizeNumeric(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }
        
        // Remove any non-numeric characters except decimal point
        return preg_replace('/[^0-9.]/', '', $input);
    }
}
