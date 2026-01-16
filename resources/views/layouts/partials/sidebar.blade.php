<!-- resources/views/layouts/partials/sidebar.blade.php -->
<aside class="w-64 bg-dark text-white flex-shrink-0 hidden md:flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
            <i class="fas fa-shield-alt mr-2"></i>AdminPanel
        </h1>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-primary' : '' }}">
                    <i class="fas fa-home mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            @can('view-users')
            <!-- Users -->
            <li>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.users.*') ? 'bg-primary' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    <span>Users</span>
                </a>
            </li>
            @endcan
            
            @can('view-roles')
            <!-- Roles -->
            <li>
                <a href="{{ route('admin.roles.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.roles.*') ? 'bg-primary' : '' }}">
                    <i class="fas fa-user-tag mr-3"></i>
                    <span>Roles</span>
                </a>
            </li>
            @endcan
            
            @can('manage-settings')
            <!-- Settings -->
            <li>
                <a href="#" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Settings</span>
                </a>
            </li>
            @endcan
        </ul>
    </nav>
    
    <!-- User Profile -->
    <div class="p-4 border-t border-gray-700">
        <div class="flex items-center">
            @if(auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                 alt="Avatar" 
                 class="w-10 h-10 rounded-full mr-3 object-cover">
            @else
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                <span class="text-white font-semibold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </span>
            </div>
            @endif
            <div class="flex-1 overflow-hidden">
                <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">
                    {{ auth()->user()->roles->first()?->name ?? 'User' }}
                </p>
            </div>
        </div>
    </div>
</aside>
