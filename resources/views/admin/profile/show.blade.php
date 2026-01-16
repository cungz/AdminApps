<!-- resources/views/admin/profile/show.blade.php -->
@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="text-center">
                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" 
                     alt="Avatar" 
                     class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-primary">
                @else
                <div class="w-32 h-32 rounded-full bg-primary flex items-center justify-center mx-auto mb-4 border-4 border-blue-200">
                    <span class="text-white text-4xl font-bold">
                        {{ substr($user->name, 0, 1) }}
                    </span>
                </div>
                @endif
                
                <h3 class="text-xl font-bold text-gray-800">{{ $user->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                
                <div class="mt-4">
                    @if($user->status === 'active')
                    <span class="px-4 py-2 bg-green-100 text-green-600 text-sm rounded-full font-medium inline-flex items-center">
                        <i class="fas fa-circle text-xs mr-2"></i> Active
                    </span>
                    @else
                    <span class="px-4 py-2 bg-red-100 text-red-600 text-sm rounded-full font-medium inline-flex items-center">
                        <i class="fas fa-circle text-xs mr-2"></i> Inactive
                    </span>
                    @endif
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="block w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Account Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Account Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">User ID</span>
                    <span class="text-gray-800">{{ $user->id }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Full Name</span>
                    <span class="text-gray-800">{{ $user->name }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Email Address</span>
                    <span class="text-gray-800">{{ $user->email }}</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Last Login</span>
                    <span class="text-gray-800">
                        {{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i A') : 'Never' }}
                    </span>
                </div>
                <div class="flex items-center justify-between py-3">
                    <span class="text-gray-600 font-medium">Member Since</span>
                    <span class="text-gray-800">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Roles & Permissions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Roles & Permissions</h3>
            </div>
            <div class="p-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-3">Your Roles</h4>
                <div class="flex flex-wrap gap-2 mb-6">
                    @forelse($user->roles as $role)
                    <span class="px-4 py-2 bg-purple-100 text-secondary rounded-lg font-medium">
                        <i class="fas fa-user-tag mr-2"></i>{{ $role->name }}
                    </span>
                    @empty
                    <p class="text-gray-500 text-sm">No roles assigned</p>
                    @endforelse
                </div>
                
                <h4 class="text-sm font-semibold text-gray-700 mb-3">Your Permissions</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @php
                        $allPermissions = $user->roles->flatMap(function($role) {
                            return $role->permissions;
                        })->unique('id');
                    @endphp
                    
                    @forelse($allPermissions as $permission)
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm col-span-2">No permissions assigned</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection