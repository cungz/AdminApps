<?php
// database/seeders/PermissionSeeder.php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User Management
            ['name' => 'View Users', 'slug' => 'view-users', 'description' => 'Can view user list'],
            ['name' => 'Create Users', 'slug' => 'create-users', 'description' => 'Can create new users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users', 'description' => 'Can edit user details'],
            ['name' => 'Delete Users', 'slug' => 'delete-users', 'description' => 'Can delete users'],
            
            // Role Management
            ['name' => 'View Roles', 'slug' => 'view-roles', 'description' => 'Can view role list'],
            ['name' => 'Create Roles', 'slug' => 'create-roles', 'description' => 'Can create new roles'],
            ['name' => 'Edit Roles', 'slug' => 'edit-roles', 'description' => 'Can edit role details'],
            ['name' => 'Delete Roles', 'slug' => 'delete-roles', 'description' => 'Can delete roles'],
            
            // Permission Management
            ['name' => 'Manage Permissions', 'slug' => 'manage-permissions', 'description' => 'Can manage all permissions'],
            
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'view-dashboard', 'description' => 'Can access dashboard'],
            
            // Settings
            ['name' => 'Manage Settings', 'slug' => 'manage-settings', 'description' => 'Can manage system settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}