<!-- resources/views/layouts/partials/navbar.blade.php - UPDATED -->
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
            <!-- Notifications -->
            <button class="relative text-gray-600 hover:text-primary transition p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    3
                </span>
            </button>
            
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
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
                     style="display: none;">
                    
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-user mr-2"></i> My Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    
                    <hr class="my-2">
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>