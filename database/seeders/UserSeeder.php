<?php
// database/seeders/UserSeeder.php - FIXED VERSION

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure roles exist
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        $adminRole = Role::where('slug', 'admin')->first();
        $managerRole = Role::where('slug', 'manager')->first();
        $userRole = Role::where('slug', 'user')->first();

        if (!$superAdminRole || !$adminRole || !$managerRole || !$userRole) {
            $this->command->error('❌ Roles not found! Please run RoleSeeder first.');
            return;
        }

        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $superAdmin->roles()->attach($superAdminRole->id);
        $this->command->info('✅ Super Admin created');

        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->roles()->attach($adminRole->id);
        $this->command->info('✅ Admin created');

        // Create Manager
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@admin.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $manager->roles()->attach($managerRole->id);
        $this->command->info('✅ Manager created');

        // Create Regular User
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@admin.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $user->roles()->attach($userRole->id);
        $this->command->info('✅ Regular User created');
    }
}