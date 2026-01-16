<!-- resources/views/admin/users/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Edit User Information</h3>
            <p class="text-gray-600 text-sm mt-1">Update the user details below.</p>
        </div>
        
        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Avatar Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Profile Picture</label>
                <div class="flex items-center space-x-4">
                    <div id="avatar-preview" class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                        @else
                        <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file" 
                               id="avatar" 
                               name="avatar" 
                               accept="image/*"
                               class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-600">
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG or GIF (MAX. 2MB)</p>
                    </div>
                </div>
                @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror" 
                       required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror" 
                       required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Password (Optional) -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-800 mb-3">
                    <i class="fas fa-info-circle mr-2"></i>
                    Leave password fields empty if you don't want to change the password.
                </p>
                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            New Password
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror" 
                               placeholder="••••••••">
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                               placeholder="••••••••">
                    </div>
                </div>
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror"
                        required>
                    <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Roles -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Roles <span class="text-red-500">*</span>
                </label>
                <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-300 rounded-lg p-4">
                    @foreach($roles as $role)
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" 
                               name="roles[]" 
                               value="{{ $role->id }}"
                               {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}
                               class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <span class="ml-3 text-gray-700">{{ $role->name }}</span>
                        @if($role->description)
                        <span class="ml-2 text-xs text-gray-500">- {{ $role->description }}</span>
                        @endif
                    </label>
                    @endforeach
                </div>
                @error('roles')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save mr-2"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').innerHTML = 
                    `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection