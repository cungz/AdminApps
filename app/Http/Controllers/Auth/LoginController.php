<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Update last login
            auth()->user()->update([
                'last_login_at' => now(),
            ]);

            // Check if user is active
            if (!auth()->user()->isActive()) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Your account is inactive. Please contact administrator.',
                ]);
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, ' . auth()->user()->name . '!');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}