<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@itsupport.local'],
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'department' => 'IT',
                'is_active' => true,
            ]
        );

        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole && !$admin->roles()->where('role_id', $superAdminRole->id)->exists()) {
            $admin->roles()->attach($superAdminRole);
        }

        // Demo user biasa
        $demoUser = User::firstOrCreate(
            ['email' => 'user@itsupport.local'],
            [
                'name' => 'Demo User',
                'username' => 'user',
                'password' => Hash::make('password'),
                'phone' => '089876543210',
                'department' => 'HRD',
                'is_active' => true,
            ]
        );

        $userRole = Role::where('name', 'user')->first();
        if ($userRole && !$demoUser->roles()->where('role_id', $userRole->id)->exists()) {
            $demoUser->roles()->attach($userRole);
        }
    }
}
