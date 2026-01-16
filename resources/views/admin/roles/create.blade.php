<?php
<!-- resources/views/admin/roles/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Role')
@section('page-title', 'Create New Role')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Role Information</h3>
            <p class="text-gray-600 text-sm mt-1">Create a new role with specific permissions.</p>
        </div>
        
        <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6 space-y-6">
            @csrf
            
            <!-- Role Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Role Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror" 
                       placeholder="e.g., Content Manager"
                       required>
                <p class="text-xs text-gray-500 mt-1">Slug will be auto-generated from the name</p>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror" 
                          placeholder="Brief description of this role's responsibilities...">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permissions -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Permissions <span class="text-red-500">*</span>
                </label>
                
                <div class="border border-gray-300 rounded-lg p-4">
                    <!-- Select All -->
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
                            <input type="checkbox" 
                                   id="select-all" 
                                   class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                            <span class="ml-3 font-semibold text-gray-800">
                                <i class="fas fa-check-double mr-2"></i>Select All Permissions
                            </span>
                        </label>
                    </div>
                    
                    <!-- Permissions by Category -->
                    @php
                        $categories = [
                            'User Management' => ['view-users', 'create-users', 'edit-users', 'delete-users'],
                            'Role Management' => ['view-roles', 'create-roles', 'edit-roles', 'delete-roles'],
                            'System' => ['view-dashboard', 'manage-permissions', 'manage-settings'],
                        ];
                    @endphp
                    
                    <div class="space-y-4">
                        @foreach($categories as $category => $permSlugs)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-folder text-primary mr-2"></i>
                                {{ $category }}
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 ml-6">
                                @foreach($permissions->whereIn('slug', $permSlugs) as $permission)
                                <label class="flex items-center p-2 hover:bg-white rounded cursor-pointer transition">
                                    <input type="checkbox" 
                                           name="permissions[]" 
                                           value="{{ $permission->id }}"
                                           {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                           class="permission-checkbox w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-700">{{ $permission->name }}</span>
                                        @if($permission->description)
                                        <p class="text-xs text-gray-500">{{ $permission->description }}</p>
                                        @endif
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                @error('permissions')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.roles.index') }}" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save mr-2"></i> Create Role
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allCheckboxes = document.querySelectorAll('.permission-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.permission-checkbox:checked');
            document.getElementById('select-all').checked = allCheckboxes.length === checkedCheckboxes.length;
        });
    });
</script>
@endpush
@endsection

