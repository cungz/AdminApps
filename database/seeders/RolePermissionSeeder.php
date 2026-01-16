<?php
// database/seeders/RolePermissionSeeder.php - FIXED VERSION

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin gets all permissions
        $superAdmin = Role::where('slug', 'super-admin')->first();
        if ($superAdmin) {
            $allPermissions = Permission::all()->pluck('id');
            $superAdmin->permissions()->sync($allPermissions);
            $this->command->info('✅ Super Admin permissions assigned');
        }

        // Admin permissions
        $admin = Role::where('slug', 'admin')->first();
        if ($admin) {
            $adminPermissions = Permission::whereIn('slug', [
                'view-users', 'create-users', 'edit-users',
                'view-roles', 'view-dashboard', 'manage-settings'
            ])->pluck('id');
            $admin->permissions()->sync($adminPermissions);
            $this->command->info('✅ Admin permissions assigned');
        }

        // Manager permissions
        $manager = Role::where('slug', 'manager')->first();
        if ($manager) {
            $managerPermissions = Permission::whereIn('slug', [
                'view-users', 'edit-users', 'view-dashboard'
            ])->pluck('id');
            $manager->permissions()->sync($managerPermissions);
            $this->command->info('✅ Manager permissions assigned');
        }

        // User permissions
        $user = Role::where('slug', 'user')->first();
        if ($user) {
            $userPermissions = Permission::whereIn('slug', [
                'view-dashboard'
            ])->pluck('id');
            $user->permissions()->sync($userPermissions);
            $this->command->info('✅ User permissions assigned');
        }
    }
}