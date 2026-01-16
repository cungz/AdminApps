<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full access to all system features'
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrative access with some restrictions'
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Can manage users and basic settings'
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Basic user access'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}