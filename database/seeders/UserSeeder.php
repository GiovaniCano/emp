<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // users
        $super_admin_user = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'a@a.com',
        ]);
        $admins_users = User::factory(2)->create();
        $writters_users = User::factory(2)->create();

        // assign roles
        $super_admin_user->assignRole('super admin');

        foreach ($admins_users as $admin_user) {
            $admin_user->assignRole('admin');
        }

        foreach ($writters_users as $writter_user) {
            $writter_user->assignRole('writer');
        }
    }
}
