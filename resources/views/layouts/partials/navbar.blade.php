<!-- resources/views/layouts/partials/navbar.blade.php - UPDATED FUNCTIONAL VERSION -->
<header class="bg-white border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        <!-- Mobile Menu Button + Page Title -->
        <div class="flex items-center space-x-4 flex-1">
            <!-- Mobile Menu Button -->
            <button onclick="toggleSidebar()" 
                    class="md:hidden text-gray-600 hover:text-primary p-2 rounded-lg hover:bg-gray-100 transition">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Page Title -->
            <h2 class="text-2xl font-bold text-gray-800">
                @yield('page-title', 'Dashboard')
            </h2>
        </div>
        
        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="relative text-gray-600 hover:text-primary transition p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bell text-xl"></i>
                    <!-- Unread Badge -->
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">
                        2
                    </span>
                </button>
                
                <!-- Notifications Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-96 overflow-y-auto"
                     style="display: none;">
                    
                    <!-- Header -->
                    <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-800">Notifications</h3>
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="text-xs text-primary hover:text-blue-600">
                            View All
                        </a>
                    </div>
                    
                    <!-- Notification Items -->
                    <div class="divide-y divide-gray-100">
                        <!-- Notification 1 -->
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="block px-4 py-3 hover:bg-gray-50 transition">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">New User Registered</p>
                                    <p class="text-xs text-gray-600 mt-1">John Doe has registered a new account</p>
                                    <p class="text-xs text-gray-500 mt-1">5 minutes ago</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Notification 2 -->
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="block px-4 py-3 hover:bg-gray-50 transition">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">Role Updated</p>
                                    <p class="text-xs text-gray-600 mt-1">Admin role permissions modified</p>
                                    <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Notification 3 (Read) -->
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="block px-4 py-3 hover:bg-gray-50 transition opacity-60">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800">System Update</p>
                                    <p class="text-xs text-gray-600 mt-1">New features available</p>
                                    <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Footer -->
                    <div class="px-4 py-3 border-t border-gray-200 text-center">
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="text-sm text-primary hover:text-blue-600 font-medium">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="flex items-center space-x-2 hover:bg-gray-100 rounded-lg px-3 py-2 transition">
                    @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                         alt="Avatar" 
                         class="w-8 h-8 rounded-full object-cover">
                    @else
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    </div>
                    @endif
                    <span class="hidden sm:block text-sm font-medium text-gray-700">
                        {{ auth()->user()->name }}
                    </span>
                    <i class="fas fa-chevron-down text-sm text-gray-600"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50"
                     style="display: none;">
                    
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        <div class="mt-2">
                            @foreach(auth()->user()->roles as $role)
                            <span class="inline-block px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">
                                {{ $role->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Menu Items -->
                    <a href="{{ route('admin.profile.show') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-user mr-3 w-4"></i> My Profile
                    </a>
                    
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-edit mr-3 w-4"></i> Edit Profile
                    </a>
                    
                    @can('manage-settings')
                    <a href="{{ route('admin.settings.index') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-cog mr-3 w-4"></i> Settings
                    </a>
                    @endcan
                    
                    <hr class="my-2">
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt mr-3 w-4"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>