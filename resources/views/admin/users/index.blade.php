<!-- resources/views/admin/users/index.blade.php - FIXED VERSION -->
@extends('layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <!-- Header -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div>
                <h3 class="text-xl font-bold text-gray-800">All Users</h3>
                <p class="text-gray-600 text-sm mt-1">Manage your users and their account permissions here.</p>
            </div>
            @can('create-users')
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                <i class="fas fa-plus mr-2"></i> Add New User
            </a>
            @endcan
        </div>
    </div>
    
    <!-- Filters -->
    <div class="p-6 border-b border-gray-100 bg-gray-50">
        <form method="GET" action="{{ route('admin.users.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="search"
                               name="search" 
                               value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" 
                               placeholder="Search by name or email...">
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" 
                            id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Role Filter -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" 
                            id="role"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->slug }}" {{ request('role') === $role->slug ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-filter mr-2"></i> Apply Filters
                </button>
                <a href="{{ route('admin.users.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
                
                <!-- Active Filter Badges -->
                @if(request()->hasAny(['search', 'status', 'role']))
                <div class="flex items-center flex-wrap gap-2 ml-2">
                    <span class="text-sm text-gray-600">Active filters:</span>
                    
                    @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full">
                        <i class="fas fa-search mr-1"></i> "{{ request('search') }}"
                        <a href="{{ route('admin.users.index', request()->except('search')) }}" class="ml-2 hover:text-blue-900">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    @if(request('status'))
                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">
                        <i class="fas fa-circle mr-1"></i> {{ ucfirst(request('status')) }}
                        <a href="{{ route('admin.users.index', request()->except('status')) }}" class="ml-2 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    @if(request('role'))
                    <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 text-sm rounded-full">
                        <i class="fas fa-user-tag mr-1"></i> {{ $roles->firstWhere('slug', request('role'))?->name }}
                        <a href="{{ route('admin.users.index', request()->except('role')) }}" class="ml-2 hover:text-purple-900">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                </div>
                @endif
            </div>
        </form>
    </div>
    
    <!-- Results Info -->
    <div class="px-6 py-3 bg-gray-50 border-b border-gray-100">
        <p class="text-sm text-gray-600">
            Showing <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span> 
            to <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span> 
            of <span class="font-semibold">{{ $users->total() }}</span> users
        </p>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr class="text-left text-gray-600 text-sm">
                    <th class="px-6 py-4 font-semibold">User</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold">Role</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Last Login</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 alt="Avatar" 
                                 class="w-10 h-10 rounded-full mr-3 object-cover">
                            @else
                            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                                <span class="text-white font-semibold">
                                    {{ substr($user->name, 0, 1) }}
                                </span>
                            </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $user->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($user->roles as $role)
                            <span class="px-2 py-1 bg-purple-100 text-secondary text-xs rounded-full font-medium">
                                {{ $role->name }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->status === 'active')
                        <span class="px-3 py-1 bg-green-100 text-green-600 text-xs rounded-full font-medium">
                            <i class="fas fa-circle text-xs mr-1"></i> Active
                        </span>
                        @else
                        <span class="px-3 py-1 bg-red-100 text-red-600 text-xs rounded-full font-medium">
                            <i class="fas fa-circle text-xs mr-1"></i> Inactive
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600 text-sm">
                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" 
                               title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @can('edit-users')
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            
                            @can('delete-users')
                            @if($user->id !== auth()->id())
                            <form method="POST" 
                                  action="{{ route('admin.users.destroy', $user) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <i class="fas fa-users text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg">No users found</p>
                        @if(request()->hasAny(['search', 'status', 'role']))
                        <p class="text-gray-400 text-sm mt-2">Try adjusting your filters</p>
                        <a href="{{ route('admin.users.index') }}" class="inline-block mt-3 text-primary hover:text-blue-600">
                            Clear all filters
                        </a>
                        @else
                        <p class="text-gray-400 text-sm mt-2">Get started by creating a new user</p>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="p-6 border-t border-gray-100">
        {{ $users->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Auto-submit on select change (optional)
    document.getElementById('status').addEventListener('change', function() {
        // Uncomment to auto-submit
        // this.form.submit();
    });
    
    document.getElementById('role').addEventListener('change', function() {
        // Uncomment to auto-submit
        // this.form.submit();
    });
</script>
@endpush
@endsection