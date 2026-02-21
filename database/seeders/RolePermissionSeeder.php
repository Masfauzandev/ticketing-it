<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Create Permissions ──
        $permissions = [
            ['name' => 'module.ticketing', 'display_name' => 'Akses Ticketing', 'module' => 'ticketing'],
            ['name' => 'module.monitoring', 'display_name' => 'Akses Monitoring', 'module' => 'monitoring'],
            ['name' => 'module.asset', 'display_name' => 'Akses Asset', 'module' => 'asset'],
            ['name' => 'module.userguide', 'display_name' => 'Akses User Guide', 'module' => 'userguide'],
            ['name' => 'module.admin', 'display_name' => 'Akses Admin Panel', 'module' => 'admin'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm['name']], $perm);
        }

        // ── Create Roles ──
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin'], [
            'display_name' => 'Super Admin',
            'description' => 'Akses penuh ke semua modul dan pengaturan sistem',
        ]);

        $admin = Role::firstOrCreate(['name' => 'admin'], [
            'display_name' => 'Administrator',
            'description' => 'Akses ke modul tertentu dan manajemen terbatas',
        ]);

        $itSupport = Role::firstOrCreate(['name' => 'it_support'], [
            'display_name' => 'IT Support',
            'description' => 'Staff IT Support, akses ke modul sesuai assignment',
        ]);

        $user = Role::firstOrCreate(['name' => 'user'], [
            'display_name' => 'User',
            'description' => 'Pengguna biasa, akses terbatas',
        ]);

        // ── Assign Permissions to Roles ──
        $allPermissions = Permission::all()->pluck('id');
        $superAdmin->permissions()->sync($allPermissions);

        $admin->permissions()->sync(
            Permission::whereIn('name', [
                'module.ticketing',
                'module.monitoring',
                'module.asset',
                'module.userguide',
                'module.admin'
            ])->pluck('id')
        );

        $itSupport->permissions()->sync(
            Permission::whereIn('name', [
                'module.ticketing',
                'module.monitoring',
                'module.asset',
                'module.userguide'
            ])->pluck('id')
        );

        $user->permissions()->sync(
            Permission::whereIn('name', [
                'module.ticketing',
                'module.userguide'
            ])->pluck('id')
        );
    }
}
