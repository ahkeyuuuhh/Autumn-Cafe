# Security Quick Reference Guide

## For Developers Working on Autumn Café

---

## ⚠️ CRITICAL SECURITY RULES

### 1. NEVER Use Raw SQL Queries
❌ **WRONG:**
```php
DB::select("SELECT * FROM users WHERE email = '".$email."'");
```

✅ **CORRECT:**
```php
User::where('email', $email)->first();
```

### 2. ALWAYS Escape User Output
❌ **WRONG:**
```blade
{!! $customer->name !!}
```

✅ **CORRECT:**
```blade
{{ $customer->name }}
```

### 3. ALWAYS Include CSRF Tokens in Forms
❌ **WRONG:**
```html
<form method="POST" action="/submit">
    <input name="data" />
</form>
```

✅ **CORRECT:**
```html
<form method="POST" action="/submit">
    @csrf
    <input name="data" />
</form>
```

### 4. ALWAYS Validate User Input
❌ **WRONG:**
```php
public function store(Request $request) {
    Customer::create($request->all());
}
```

✅ **CORRECT:**
```php
public function store(StoreCustomerRequest $request) {
    $validated = $request->validated();
    Customer::create($validated);
}
```

---

## 📋 Common Tasks

### Adding a New Form Field

1. **Add Backend Validation** (in Form Request or Controller):
```php
$validated = $request->validate([
    'new_field' => [
        'required',
        'string',
        'max:255',
        'regex:/^[a-zA-Z0-9\s]+$/', // Only safe characters
    ],
]);
```

2. **Add Frontend Sanitization**:
```javascript
// In your form's JavaScript
document.getElementById('new_field').addEventListener('input', function(e) {
    // Remove dangerous characters
    this.value = this.value.replace(/[<>'"]/g, '');
});
```

3. **Sanitize Before Storing**:
```php
$validated['new_field'] = strip_tags(trim($validated['new_field']));
```

---

### Creating a New Controller Method

```php
public function myNewMethod(Request $request)
{
    // 1. Validate input
    $validated = $request->validate([
        'field' => 'required|string|max:255',
    ]);
    
    // 2. Sanitize (if not using Form Request)
    $validated['field'] = strip_tags(trim($validated['field']));
    
    // 3. Use Eloquent (never raw SQL)
    $result = Model::where('column', $validated['field'])->first();
    
    // 4. Escape output in response
    return response()->json([
        'data' => htmlspecialchars($result->field, ENT_QUOTES, 'UTF-8')
    ]);
}
```

---

### Adding a New Form Request Class

```bash
# Create the request class
php artisan make:request StoreXyzRequest
```

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreXyzRequest extends FormRequest
{
    public function authorize(): bool
    {
        return session()->has('user_id'); // Adjust based on role
    }

    public function rules(): array
    {
        return [
            'field' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s]+$/',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'field' => $this->sanitizeInput($this->field),
        ]);
    }

    private function sanitizeInput(?string $input): ?string
    {
        if ($input === null) return null;
        $sanitized = strip_tags($input);
        $sanitized = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $sanitized);
        return trim($sanitized);
    }
}
```

---

## 🔐 Validation Regex Patterns

### Name Fields
```php
'regex:/^[a-zA-Z\s\.\-\']+$/' // Letters, spaces, dots, hyphens, apostrophes
```

### Email
```php
'email:rfc,dns'
'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
```

### Philippine Phone Number
```php
'regex:/^(\+63|0)[0-9]{10}$/' // +639123456789 or 09123456789
```

### Price (Decimal)
```php
'regex:/^\d+(\.\d{1,2})?$/' // 99.99 format
```

### Alphanumeric with Basic Punctuation
```php
'regex:/^[a-zA-Z0-9\s\-\&\.\,\']+$/'
```

### Description (Safe Characters)
```php
'regex:/^[a-zA-Z0-9\s\-\&\.\,\'\"!?()]+$/'
```

---

## 🛡️ Frontend Sanitization Functions

Use these in your JavaScript forms:

```javascript
// From resources/js/validation.js

// Sanitize text input
const sanitized = InputValidator.sanitizeText(userInput);

// Validate email
const result = InputValidator.validateEmail(email);
if (!result.isValid) {
    InputValidator.showError(emailInput, result.error);
}

// Validate phone
const result = InputValidator.validatePhone(phone);

// Validate price
const result = InputValidator.validatePrice(price);

// Validate integer
const result = InputValidator.validateInteger(stock, 0, 9999);

// Escape HTML
const safe = InputValidator.escapeHtml(dangerousString);
```

---

## 🚫 Security DON'Ts

### 1. Don't Trust User Input
```php
// ❌ NEVER do this
$sql = "SELECT * FROM users WHERE id = " . $_GET['id'];

// ✅ ALWAYS validate and use ORM
$validated = $request->validate(['id' => 'required|integer']);
$user = User::find($validated['id']);
```

### 2. Don't Store Passwords in Plain Text
```php
// ❌ NEVER
User::create(['password' => $request->password]);

// ✅ ALWAYS hash
User::create(['password' => Hash::make($request->password)]);
```

### 3. Don't Use eval() or exec()
```php
// ❌ NEVER use these functions
eval($userInput);
exec($userInput);
```

### 4. Don't Expose Sensitive Data
```php
// ❌ Don't return full user object with password
return response()->json($user);

// ✅ Return only needed fields
return response()->json($user->only(['id', 'name', 'email']));
```

### 5. Don't Forget to Sanitize
```php
// ❌ Direct storage
session(['name' => $customer->name]);

// ✅ Sanitize first
session(['name' => htmlspecialchars($customer->name, ENT_QUOTES, 'UTF-8')]);
```

---

## ✅ Security Checklist for Code Review

Before committing code, check:

- [ ] All user inputs are validated (backend)
- [ ] All user inputs are sanitized (frontend + backend)
- [ ] All forms have `@csrf` tokens
- [ ] All outputs use `{{ }}` not `{!! !!}`
- [ ] All database queries use Eloquent ORM
- [ ] All passwords are hashed with `Hash::make()`
- [ ] All file uploads are validated (type, size, dimensions)
- [ ] All Form Requests have `authorize()` checks
- [ ] All sensitive operations check authentication
- [ ] No hardcoded credentials in code

---

## 🔍 Testing Your Security Implementation

### XSS Testing
Try these inputs in forms:
```
<script>alert('XSS')</script>
<img src=x onerror=alert('XSS')>
javascript:alert('XSS')
<iframe src="javascript:alert('XSS')"></iframe>
```
**Expected Result**: Inputs should be sanitized or rejected

### SQL Injection Testing
Try these inputs:
```
' OR '1'='1
'; DROP TABLE users--
admin'--
```
**Expected Result**: Queries should fail safely or treat as literal strings

### CSRF Testing
1. Remove `@csrf` from a form
2. Try to submit
**Expected Result**: 419 Page Expired error

---

## 📚 Additional Resources

- [Laravel Security Best Practices](https://laravel.com/docs/11.x/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/PHP_Configuration_Cheat_Sheet.html)
- [Content Security Policy Reference](https://content-security-policy.com/)

---

## 🆘 Need Help?

1. Check `SECURITY.md` for comprehensive documentation
2. Review existing Form Request classes in `app/Http/Requests/`
3. Look at `resources/js/validation.js` for frontend examples
4. Test in development first: `php artisan serve`

---

## 🎯 Quick Commands

```bash
# Run security audit
composer audit

# Clear all caches
php artisan optimize:clear

# Run tests
php artisan test

# Check code style
./vendor/bin/phpcs

# View routes
php artisan route:list
```

---

**Remember**: Security is not optional. Every line of code that handles user input is a potential vulnerability. When in doubt, validate, sanitize, and escape!
