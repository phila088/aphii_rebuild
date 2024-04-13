<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'created_by' => null,
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'name' => 'System Administrator',
                'email' => 'admin@aphii.co',
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'email_verified_at' => now(),
                'active' => true,
                'locked' => false,
                'employee' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'created_by' => 1,
                'first_name' => 'Adam',
                'last_name' => 'Phillips',
                'name' => 'Adam Phillips',
                'email' => 'adamp@aphii.co',
                'password' => Hash::make('L9Red$$Lknta832!@12'),
                'email_verified_at' => now(),
                'active' => true,
                'locked' => false,
                'employee' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('user_profiles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'timezone' => 'America/New_York'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'timezone' => 'America/New_York'
            ],
        ]);
    }
}
