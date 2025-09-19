<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Super Admin Users
        $superAdmin1 = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $superAdmin1->assignRole('super admin');

        $superAdmin2 = User::create([
            'name' => 'Super Admin 2',
            'email' => 'superadmin2@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $superAdmin2->assignRole('super admin');

        // Admin Users
        $admin1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $admin1->assignRole('admin');

        $admin2 = User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $admin2->assignRole('admin');

        $admin3 = User::create([
            'name' => 'Admin 3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $admin3->assignRole('admin');
    }
}