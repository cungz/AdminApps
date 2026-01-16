<!-- resources/views/admin/notifications/index.blade.php -->
@extends('layouts.app')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <!-- Header -->
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800">All Notifications</h3>
                <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}">
                    @csrf
                    <button type="submit" class="text-sm text-primary hover:text-blue-600 font-medium">
                        <i class="fas fa-check-double mr-1"></i> Mark all as read
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Notifications List -->
        <div class="divide-y divide-gray-100">
            @forelse($notifications as $notification)
            <div class="p-6 hover:bg-gray-50 transition {{ $notification['read'] ? 'opacity-60' : '' }}">
                <div class="flex items-start">
                    <div class="w-12 h-12 {{ $notification['icon_class'] }} rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas {{ $notification['icon'] }}"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $notification['title'] }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $notification['message'] }}</p>
                                <p class="text-xs text-gray-500 mt-2">
                                    <i class="fas fa-clock mr-1"></i> {{ $notification['time'] }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if(!$notification['read'])
                                <form method="POST" action="{{ route('admin.notifications.mark-read', $notification['id']) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="text-primary hover:text-blue-600 p-2" 
                                            title="Mark as read">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                
                                <form method="POST" 
                                      action="{{ route('admin.notifications.destroy', $notification['id']) }}"
                                      onsubmit="return confirm('Delete this notification?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-600 p-2" 
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center">
                <i class="fas fa-bell-slash text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg">No notifications</p>
                <p class="text-gray-400 text-sm mt-2">You're all caught up!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection