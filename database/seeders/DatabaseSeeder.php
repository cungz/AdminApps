<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // IMPORTANT: Run in this exact order!
        $this->call([
            RoleSeeder::class,           // 1. Create roles first
            PermissionSeeder::class,     // 2. Create permissions
            RolePermissionSeeder::class, // 3. Attach permissions to roles
            UserSeeder::class,           // 4. Create users last (needs roles to exist)
        ]);
        
        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Login credentials:');
        $this->command->info('   Super Admin: superadmin@admin.com / password');
        $this->command->info('   Admin: admin@admin.com / password');
    }
}