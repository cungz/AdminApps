<!-- resources/views/admin/roles/index.blade.php -->
@extends('layouts.app')

@section('title', 'Roles Management')
@section('page-title', 'Roles Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <!-- Header -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h3 class="text-xl font-bold text-gray-800">All Roles</h3>
                <p class="text-gray-600 text-sm mt-1">Manage system roles and their permissions.</p>
            </div>
            @can('create-roles')
            <a href="{{ route('admin.roles.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                <i class="fas fa-plus mr-2"></i> Create New Role
            </a>
            @endcan
        </div>
    </div>
    
    <!-- Roles Grid -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($roles as $role)
            <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-tag text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $role->name }}</h4>
                            <p class="text-xs text-gray-500">{{ $role->slug }}</p>
                        </div>
                    </div>
                </div>
                
                @if($role->description)
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $role->description }}</p>
                @endif
                
                <div class="flex items-center justify-between mb-4 py-3 border-t border-gray-200">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-800">{{ $role->users_count }}</p>
                        <p class="text-xs text-gray-600">Users</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-800">{{ $role->permissions_count }}</p>
                        <p class="text-xs text-gray-600">Permissions</p>
                    </div>
                </div>
                
                <div class="flex space-x-2">
                    @can('edit-roles')
                    <a href="{{ route('admin.roles.edit', $role) }}" 
                       class="flex-1 px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-blue-600 transition text-center">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    @endcan
                    
                    @can('delete-roles')
                    @if($role->slug !== 'super-admin')
                    <form method="POST" 
                          action="{{ route('admin.roles.destroy', $role) }}" 
                          onsubmit="return confirm('Are you sure? Users with this role will lose their permissions.');"
                          class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-3 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                    @endif
                    @endcan
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-user-tag text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg">No roles found</p>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Pagination -->
    @if($roles->hasPages())
    <div class="p-6 border-t border-gray-100">
        {{ $roles->links() }}
    </div>
    @endif
</div>
@endsection