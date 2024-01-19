<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class _DatabaseSeeder_prod extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);

        $super_admin_user = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'a@a.com',
        ]);

        $super_admin_user->assignRole('super admin');
    }
}
