<!-- resources/views/auth/register.blade.php -->
@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="bg-white rounded-2xl shadow-2xl p-8">
    <!-- Logo & Title -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl mb-4">
            <i class="fas fa-user-plus text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
        <p class="text-gray-600 mt-2">Join us today! It only takes a minute</p>
    </div>
    
    <!-- Register Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                Full Name
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition @error('name') border-red-500 @enderror" 
                       placeholder="John Doe"
                       required>
            </div>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
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
                       placeholder="john@example.com"
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
        
        <!-- Password Confirmation -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                Confirm Password
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition" 
                       placeholder="••••••••"
                       required>
            </div>
        </div>
        
        <!-- Terms & Conditions -->
        <div class="flex items-start">
            <input type="checkbox" 
                   id="terms" 
                   class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary mt-1"
                   required>
            <label for="terms" class="ml-2 text-sm text-gray-600">
                I agree to the <a href="#" class="text-primary hover:text-secondary">Terms and Conditions</a> 
                and <a href="#" class="text-primary hover:text-secondary">Privacy Policy</a>
            </label>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
            <i class="fas fa-user-plus mr-2"></i> Create Account
        </button>
    </form>
    
    <!-- Login Link -->
    <p class="text-center text-sm text-gray-600 mt-6">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-primary font-semibold hover:text-secondary transition">
            Sign in here
        </a>
    </p>
</div>
@endsection