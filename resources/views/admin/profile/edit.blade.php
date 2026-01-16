<!-- resources/views/admin/profile/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="max-w-4xl">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Picture -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Profile Picture</h3>
                
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="text-center">
                        @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                             id="avatar-preview"
                             class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-primary">
                        @else
                        <div id="avatar-preview" class="w-32 h-32 rounded-full bg-primary flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-4xl font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        </div>
                        @endif
                        
                        <input type="file" 
                               id="avatar-input" 
                               name="avatar" 
                               accept="image/*"
                               class="hidden">
                        
                        <button type="button" 
                                onclick="document.getElementById('avatar-input').click()"
                                class="w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition mb-2">
                            <i class="fas fa-camera mr-2"></i> Change Photo
                        </button>
                        
                        @if(auth()->user()->avatar)
                        <button type="button"
                                onclick="event.preventDefault(); document.getElementById('delete-avatar-form').submit();"
                                class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-2"></i> Remove Photo
                        </button>
                        @endif
                    </div>
                </form>
                
                @if(auth()->user()->avatar)
                <form id="delete-avatar-form" 
                      method="POST" 
                      action="{{ route('admin.profile.delete-avatar') }}" 
                      class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
            </div>
        </div>
        
        <!-- Edit Forms -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Basic Information</h3>
                </div>
                
                <form method="POST" action="{{ route('admin.profile.update') }}" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('admin.profile.show') }}" 
                           class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Change Password Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Change Password</h3>
                </div>
                
                <form method="POST" action="{{ route('admin.profile.update-password') }}" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Current Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('current_password') border-red-500 @enderror"
                               required>
                        @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            New Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirm New Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               required>
                    </div>
                    
                    <div class="flex justify-end pt-4">
                        <button type="submit" 
                                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                            <i class="fas fa-key mr-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').innerHTML = 
                    `<img src="${e.target.result}" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-primary">`;
            }
            reader.readAsDataURL(file);
            
            // Auto-submit form
            e.target.form.submit();
        }
    });
</script>
@endpush
@endsection