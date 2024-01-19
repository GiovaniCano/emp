<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissions
        $edit_settings = Permission::create(['name' => 'edit settings']);
        $manage_site = Permission::create(['name' => 'manage site']);
        $scan_tickets = Permission::create(['name' => 'scan tickets']);

        $edit_articles = Permission::create(['name' => 'edit articles']);

        // roles
        $super_admin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);
        $writer = Role::create(['name' => 'writer']);

        // assign permissions
        $super_admin->syncPermissions([$edit_settings, $manage_site, $scan_tickets, $edit_articles]);
        $admin->syncPermissions([$edit_settings, $manage_site, $scan_tickets, $edit_articles]);
        $writer->givePermissionTo($edit_articles);
    }
}
