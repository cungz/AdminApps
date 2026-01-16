<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Card -->
<div class="bg-gradient-to-r from-primary to-secondary rounded-xl p-6 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
            <p class="text-blue-100">Here's what's happening with your platform today.</p>
        </div>
        <div class="hidden md:block">
            <i class="fas fa-chart-line text-6xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Total Users</p>
                <h4 class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</h4>
                <p class="text-green-500 text-sm mt-2">
                    <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                </p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-primary text-xl"></i>
            </div>
        </div>
    </div>
    
    <!-- Active Users -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Active Users</p>
                <h4 class="text-3xl font-bold text-gray-800">{{ $stats['active_users'] }}</h4>
                <p class="text-green-500 text-sm mt-2">
                    <i class="fas fa-arrow-up mr-1"></i> 8% from last month
                </p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-check text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <!-- Inactive Users -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Inactive Users</p>
                <h4 class="text-3xl font-bold text-gray-800">{{ $stats['inactive_users'] }}</h4>
                <p class="text-red-500 text-sm mt-2">
                    <i class="fas fa-arrow-down mr-1"></i> 3% from last month
                </p>
            </div>
            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-times text-red-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Roles -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium mb-1">Total Roles</p>
                <h4 class="text-3xl font-bold text-gray-800">{{ $stats['total_roles'] }}</h4>
                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-minus mr-1"></i> No change
                </p>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user-tag text-secondary text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Users -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800">Recent Users</h3>
                <a href="{{ route('admin.users.index') }}" class="text-primary hover:text-secondary text-sm font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 text-sm">
                            <th class="pb-3 font-semibold">User</th>
                            <th class="pb-3 font-semibold">Email</th>
                            <th class="pb-3 font-semibold">Role</th>
                            <th class="pb-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($stats['recent_users'] as $user)
                        <tr class="border-t border-gray-100">
                            <td class="py-3">
                                <div class="flex items-center">
                                    @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                                         alt="Avatar" 
                                         class="w-8 h-8 rounded-full mr-3 object-cover">
                                    @else
                                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center mr-3">
                                        <span class="text-white text-xs font-semibold">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    @endif
                                    <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 text-gray-600">{{ $user->email }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 bg-purple-100 text-secondary text-xs rounded-full font-medium">
                                    {{ $user->roles->first()?->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-3">
                                @if($user->status === 'active')
                                <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full font-medium">
                                    Active
                                </span>
                                @else
                                <span class="px-2 py-1 bg-red-100 text-red-600 text-xs rounded-full font-medium">
                                    Inactive
                                </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>No recent users found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
        </div>
        <div class="p-6 space-y-3">
            @can('create-users')
            <a href="{{ route('admin.users.create') }}" 
               class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition group">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <span class="font-medium text-gray-800">Add New User</span>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-primary transition"></i>
            </a>
            @endcan
            
            @can('create-roles')
            <a href="{{ route('admin.roles.create') }}" 
               class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition group">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-tag text-white"></i>
                    </div>
                    <span class="font-medium text-gray-800">Create Role</span>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-secondary transition"></i>
            </a>
            @endcan
            
            @can('view-users')
            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center justify-between p-4 bg-green-50 hover:bg-green-100 rounded-lg transition group">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <span class="font-medium text-gray-800">Manage Users</span>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-green-500 transition"></i>
            </a>
            @endcan
            
            @can('manage-settings')
            <a href="#" 
               class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition group">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-cog text-white"></i>
                    </div>
                    <span class="font-medium text-gray-800">Settings</span>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-orange-500 transition"></i>
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection