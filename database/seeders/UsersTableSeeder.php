<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@app.com'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'image' => 'default.png',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        if ($superAdminRole) {
            $superAdmin->syncRoles([$superAdminRole]);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@app.com'],
            [
                'first_name' => 'Site',
                'last_name' => 'Admin',
                'image' => 'default.png',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        if ($adminRole) {
            $admin->syncRoles([$adminRole]);
        }

        $regular = User::updateOrCreate(
            ['email' => 'user@app.com'],
            [
                'first_name' => 'Regular',
                'last_name' => 'User',
                'image' => 'default.png',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        if ($userRole) {
            $regular->syncRoles([$userRole]);
        }

        User::factory()
            ->count(20)
            ->create()
            ->each(function (User $user) use ($userRole) {
                if ($userRole) {
                    $user->syncRoles([$userRole]);
                }
            });
    }
}
