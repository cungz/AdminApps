<!-- resources/views/admin/settings/index.blade.php -->
@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'System Settings')

@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- General Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">General Settings</h3>
                <p class="text-sm text-gray-600 mt-1">Configure basic application settings</p>
            </div>
            
            <div class="p-6 space-y-4">
                <!-- App Name -->
                <div>
                    <label for="app_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Application Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="app_name" 
                           name="app_name" 
                           value="{{ old('app_name', $settings['app_name']) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('app_name') border-red-500 @enderror"
                           required>
                    @error('app_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Timezone -->
                <div>
                    <label for="timezone" class="block text-sm font-semibold text-gray-700 mb-2">
                        Timezone <span class="text-red-500">*</span>
                    </label>
                    <select id="timezone" 
                            name="timezone" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('timezone') border-red-500 @enderror"
                            required>
                        <option value="UTC" {{ old('timezone', $settings['timezone']) == 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="Asia/Jakarta" {{ old('timezone', $settings['timezone']) == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB)</option>
                        <option value="Asia/Makassar" {{ old('timezone', $settings['timezone']) == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar (WITA)</option>
                        <option value="Asia/Jayapura" {{ old('timezone', $settings['timezone']) == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura (WIT)</option>
                        <option value="America/New_York" {{ old('timezone', $settings['timezone']) == 'America/New_York' ? 'selected' : '' }}>America/New_York (EST)</option>
                        <option value="Europe/London" {{ old('timezone', $settings['timezone']) == 'Europe/London' ? 'selected' : '' }}>Europe/London (GMT)</option>
                    </select>
                    @error('timezone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Date Format -->
                <div>
                    <label for="date_format" class="block text-sm font-semibold text-gray-700 mb-2">
                        Date Format <span class="text-red-500">*</span>
                    </label>
                    <select id="date_format" 
                            name="date_format" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('date_format') border-red-500 @enderror"
                            required>
                        <option value="Y-m-d" {{ old('date_format', $settings['date_format']) == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD (2024-01-17)</option>
                        <option value="d/m/Y" {{ old('date_format', $settings['date_format']) == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY (17/01/2024)</option>
                        <option value="m/d/Y" {{ old('date_format', $settings['date_format']) == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY (01/17/2024)</option>
                        <option value="M d, Y" {{ old('date_format', $settings['date_format']) == 'M d, Y' ? 'selected' : '' }}>Mon DD, YYYY (Jan 17, 2024)</option>
                    </select>
                    @error('date_format')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Time Format -->
                <div>
                    <label for="time_format" class="block text-sm font-semibold text-gray-700 mb-2">
                        Time Format <span class="text-red-500">*</span>
                    </label>
                    <select id="time_format" 
                            name="time_format" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('time_format') border-red-500 @enderror"
                            required>
                        <option value="H:i:s" {{ old('time_format', $settings['time_format']) == 'H:i:s' ? 'selected' : '' }}>24-hour (14:30:00)</option>
                        <option value="h:i A" {{ old('time_format', $settings['time_format']) == 'h:i A' ? 'selected' : '' }}>12-hour (02:30 PM)</option>
                    </select>
                    @error('time_format')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Items Per Page -->
                <div>
                    <label for="items_per_page" class="block text-sm font-semibold text-gray-700 mb-2">
                        Items Per Page <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="items_per_page" 
                           name="items_per_page" 
                           value="{{ old('items_per_page', $settings['items_per_page']) }}"
                           min="5"
                           max="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('items_per_page') border-red-500 @enderror"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Number of items to display per page (5-100)</p>
                    @error('items_per_page')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Feature Toggles -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Feature Toggles</h3>
                <p class="text-sm text-gray-600 mt-1">Enable or disable specific features</p>
            </div>
            
            <div class="p-6 space-y-4">
                <!-- Maintenance Mode -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <h4 class="font-semibold text-gray-800">Maintenance Mode</h4>
                        <p class="text-sm text-gray-600">Put the application in maintenance mode</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               name="maintenance_mode" 
                               value="1"
                               {{ $settings['maintenance_mode'] ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                
                <!-- Enable Registration -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <h4 class="font-semibold text-gray-800">User Registration</h4>
                        <p class="text-sm text-gray-600">Allow new users to register</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               name="enable_registration" 
                               value="1"
                               {{ $settings['enable_registration'] ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                
                <!-- Enable Notifications -->
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <h4 class="font-semibold text-gray-800">Notifications</h4>
                        <p class="text-sm text-gray-600">Enable system notifications</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               name="enable_notifications" 
                               value="1"
                               {{ $settings['enable_notifications'] ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- System Information (Read-only) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">System Information</h3>
                <p class="text-sm text-gray-600 mt-1">Current system details</p>
            </div>
            
            <div class="p-6 space-y-3">
                <div class="flex items-center justify-between py-2">
                    <span class="text-gray-600">Laravel Version</span>
                    <span class="font-medium text-gray-800">{{ app()->version() }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-gray-600">PHP Version</span>
                    <span class="font-medium text-gray-800">{{ phpversion() }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-gray-600">Environment</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">
                        {{ app()->environment() }}
                    </span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-gray-600">Debug Mode</span>
                    <span class="px-3 py-1 {{ config('app.debug') ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }} text-xs rounded-full font-medium">
                        {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>
@endsection