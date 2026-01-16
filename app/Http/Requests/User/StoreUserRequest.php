<?php
// app/Http/Requests/User/StoreUserRequest.php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create-users');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'status' => ['required', 'in:active,inactive'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['exists:roles,id'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'User name is required.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
            'status.required' => 'User status is required.',
            'status.in' => 'Invalid status selected.',
            'roles.required' => 'Please select at least one role.',
            'roles.min' => 'User must have at least one role.',
            'roles.*.exists' => 'Selected role does not exist.',
            'avatar.image' => 'Avatar must be an image file.',
            'avatar.mimes' => 'Avatar must be a JPEG, JPG, PNG, or GIF file.',
            'avatar.max' => 'Avatar size cannot exceed 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'roles' => 'user roles',
            'avatar' => 'profile picture',
        ];
    }
}

)