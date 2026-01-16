<!-- resources/views/auth/login.blade.php -->
@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8">
    <!-- Logo & Title -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl mb-4">
            <i class="fas fa-shield-alt text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">Welcome Back!</h2>
        <p class="text-gray-600 mt-2">Sign in to your account to continue</p>
    </div>
    
    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition @error('email') border-red-500 @enderror" 
                       placeholder="admin@admin.com"
                       required>
            </div>
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition @error('password') border-red-500 @enderror" 
                       placeholder="••••••••"
                       required>
            </div>
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" 
                       name="remember" 
                       class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-sm text-primary hover:text-secondary transition">
                Forgot password?
            </a>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>
    </form>
    
    <!-- Demo Credentials -->
    <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
        <p class="text-xs font-semibold text-gray-700 mb-2">Demo Credentials:</p>
        <p class="text-xs text-gray-600">Email: <span class="font-mono">admin@admin.com</span></p>
        <p class="text-xs text-gray-600">Password: <span class="font-mono">password</span></p>
    </div>
    
    <!-- Register Link (Optional) -->
    <p class="text-center text-sm text-gray-600 mt-6">
        Don't have an account? 
        <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-secondary transition">
            Sign up now
        </a>
    </p>
</div>
@endsection