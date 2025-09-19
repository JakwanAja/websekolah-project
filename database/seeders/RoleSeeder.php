<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'super admin']);
        
        // Create permissions (untuk nanti)
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage news']);
        Permission::create(['name' => 'manage gallery']);
        
        // Assign permissions to roles
        $superAdmin = Role::findByName('super admin');
        $superAdmin->givePermissionTo(['manage users', 'manage news', 'manage gallery']);
        
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(['manage news', 'manage gallery']);
    }
}