<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Seed the application's users and their roles.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@simontini.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin123!'),
                'role_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user@simontini.test'],
            [
                'name' => 'User',
                'password' => Hash::make('User123!'),
                'role_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
