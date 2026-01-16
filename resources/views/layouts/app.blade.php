<!-- resources/views/layouts/app.blade.php - UPDATED WITH MOBILE MENU -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#8B5CF6',
                        dark: '#1F2937',
                    }
                }
            }
        }
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Mobile sidebar animations */
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-mobile.active {
            transform: translateX(0);
        }
        
        /* Overlay */
        .sidebar-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" 
             class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
             onclick="toggleSidebar()">
        </div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-mobile md:translate-x-0 fixed md:static inset-y-0 left-0 z-50 w-64 bg-dark text-white flex-shrink-0 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    <i class="fas fa-shield-alt mr-2"></i>AdminPanel
                </h1>
                <!-- Close button for mobile -->
                <button onclick="toggleSidebar()" class="md:hidden text-white hover:text-primary transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
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
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            @include('layouts.partials.navbar')
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Alert Messages -->
                @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
                @endif
                
                @if($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-700 font-semibold">Whoops! Something went wrong.</p>
                    </div>
                    <ul class="list-disc list-inside text-red-700 ml-8">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Alpine.js for dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Prevent body scroll when sidebar is open on mobile
            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        
        // Close sidebar when clicking on a link (mobile only)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
        
        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>