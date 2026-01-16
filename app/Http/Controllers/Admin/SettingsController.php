<?php
// app/Http/Controllers/Admin/SettingsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Get current settings (for now using defaults)
        $settings = [
            'app_name' => config('app.name', 'Admin Panel'),
            'timezone' => config('app.timezone', 'UTC'),
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
            'items_per_page' => 10,
            'maintenance_mode' => false,
            'enable_registration' => true,
            'enable_notifications' => true,
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string'],
            'date_format' => ['required', 'string'],
            'time_format' => ['required', 'string'],
            'items_per_page' => ['required', 'integer', 'min:5', 'max:100'],
        ]);

        // Here you would save settings to database or config
        // For now, just show success message
        
        return back()->with('success', 'Settings updated successfully.');
    }
}

// ============================================
// SETTINGS VIEW
// ============================================