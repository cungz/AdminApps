<?php
// app/Http/Requests/Auth/LoginRequest.php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.required' => 'Password is required.',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('email', 'password');
        $remember = $this->filled('remember');

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Check if user is active
        if (!auth()->user()->isActive()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Your account is inactive. Please contact administrator.',
            ]);
        }

        // Update last login
        auth()->user()->update([
            'last_login_at' => now(),
        ]);
    }
}