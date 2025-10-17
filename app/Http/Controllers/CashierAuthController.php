<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CashierAuthController extends Controller
{
    public function showLogin()
    {
        return view('cashier.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $cashier = Cashier::where('username', $request->username)
            ->where('is_active', true)
            ->first();

        if ($cashier && Hash::check($request->password, $cashier->password)) {
            session([
                'cashier_id' => $cashier->id,
                'cashier_name' => $cashier->name,
            ]);
            return redirect()->route('cashier.dashboard')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid credentials or account is inactive.');
    }

    public function showRegister()
    {
        return view('cashier.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:cashiers,email',
            'username' => 'required|string|unique:cashiers,username|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $cashier = Cashier::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        session([
            'cashier_id' => $cashier->id,
            'cashier_name' => $cashier->name,
        ]);

        return redirect()->route('cashier.dashboard')->with('success', 'Registration successful!');
    }

    public function logout()
    {
        session()->forget(['cashier_id', 'cashier_name']);
        return redirect()->route('cashier.login')->with('success', 'Logged out successfully!');
    }
}
