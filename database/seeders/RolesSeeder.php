<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Management', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Sales', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Employee', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Client', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Vendor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Technician', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
