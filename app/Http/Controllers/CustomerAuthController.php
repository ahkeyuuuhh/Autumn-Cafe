<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
    /**
     * Show customer registration form
     */
    public function showRegisterForm()
    {
        return view('customer.auth.register');
    }

    /**
     * Handle customer registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/', // Only letters and spaces
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:customers,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Valid email format
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^(\+63|0)[0-9]{10}$/', // Philippine phone format
                'unique:customers,phone',
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.regex' => 'Phone number must be a valid Philippine number (e.g., +639123456789 or 09123456789).',
            'email.regex' => 'Please provide a valid email address.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        // Sanitize inputs before storing
        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['email'] = strtolower(strip_tags(trim($validated['email'])));
        $validated['phone'] = preg_replace('/[^0-9+]/', '', $validated['phone']);

        // Create customer with hashed password
        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log customer in
        session(['customer_id' => $customer->id]);
        session(['customer_name' => $customer->name]);

        return redirect()->route('customer.menu')
            ->with('success', 'Welcome to Autumn Café! Your account has been created successfully.');
    }

    /**
     * Show customer login form
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * Handle customer login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'max:255',
            ],
            'remember' => [
                'nullable',
                'boolean',
            ],
        ]);

        // Sanitize email input
        $email = strtolower(strip_tags(trim($validated['email'])));

        // Find customer by email using parameterized query (Eloquent ORM - safe from SQL injection)
        $customer = Customer::where('email', $email)->first();

        // Check if customer exists and password is correct
        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            // Use generic error message to prevent user enumeration
            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->withInput($request->except('password'));
        }

        // Log customer in
        session(['customer_id' => $customer->id]);
        session(['customer_name' => htmlspecialchars($customer->name, ENT_QUOTES, 'UTF-8')]);

        if ($request->remember) {
            session(['customer_remember' => true]);
        }

        return redirect()->route('customer.menu')
            ->with('success', 'Welcome back, ' . htmlspecialchars($customer->name, ENT_QUOTES, 'UTF-8') . '!');
    }

    /**
     * Handle customer logout
     */
    public function logout()
    {
        session()->forget(['customer_id', 'customer_name', 'customer_remember']);
        session()->flush();

        return redirect()->route('customer.login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show customer account settings page
     */
    public function showSettings()
    {
        if (!session('customer_id')) {
            return redirect()->route('customer.login')
                ->with('error', 'Please login to access account settings.');
        }

        $customer = Customer::findOrFail(session('customer_id'));
        return view('customer.settings', compact('customer'));
    }

    /**
     * Update customer account settings
     */
    public function updateSettings(Request $request)
    {
        if (!session('customer_id')) {
            return redirect()->route('customer.login')
                ->with('error', 'Please login to update account settings.');
        }

        $customer = Customer::findOrFail(session('customer_id'));

        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:customers,email,' . $customer->id,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^(\+63|0)[0-9]{10}$/',
                'unique:customers,phone,' . $customer->id,
            ],
        ]);

        // Sanitize inputs before updating
        $validated['email'] = strtolower(strip_tags(trim($validated['email'])));
        $validated['phone'] = preg_replace('/[^0-9+]/', '', $validated['phone']);

        $customer->update([
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return back()->with('success', 'Account settings updated successfully!');
    }
}
