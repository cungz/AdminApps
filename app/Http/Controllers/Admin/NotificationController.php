<?php
// app/Http/Controllers/Admin/NotificationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Get notifications (dummy for now, you can implement later)
        $notifications = $this->getDummyNotifications();
        
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Mark notification as read
        // Implement your notification logic here
        
        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllAsRead()
    {
        // Mark all notifications as read
        // Implement your notification logic here
        
        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy($id)
    {
        // Delete notification
        // Implement your notification logic here
        
        return back()->with('success', 'Notification deleted.');
    }

    private function getDummyNotifications()
    {
        return [
            [
                'id' => 1,
                'type' => 'user_created',
                'title' => 'New User Registered',
                'message' => 'John Doe has registered a new account',
                'icon' => 'fa-user-plus',
                'icon_class' => 'bg-blue-100 text-blue-600',
                'time' => '5 minutes ago',
                'read' => false,
            ],
            [
                'id' => 2,
                'type' => 'role_updated',
                'title' => 'Role Updated',
                'message' => 'Admin role permissions have been modified',
                'icon' => 'fa-user-tag',
                'icon_class' => 'bg-purple-100 text-purple-600',
                'time' => '2 hours ago',
                'read' => false,
            ],
            [
                'id' => 3,
                'type' => 'system',
                'title' => 'System Update',
                'message' => 'New features are now available',
                'icon' => 'fa-rocket',
                'icon_class' => 'bg-green-100 text-green-600',
                'time' => '1 day ago',
                'read' => true,
            ],
        ];
    }
}

