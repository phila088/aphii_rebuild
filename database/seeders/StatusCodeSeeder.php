<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCodeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_codes')->insert([
            ['for_model' => 'Client', 'code' => 'ACTIVE', 'description' => 'Client is active.'],
            ['for_model' => 'Client', 'code' => 'DNUXXX', 'description' => 'Do not use this client.'],
            ['for_model' => 'Client', 'code' => 'INACTV', 'description' => 'Client is inactive.'],
            ['for_model' => 'Client', 'code' => 'ONBRDG', 'description' => 'Onboarding client.'],
        ]);
    }
}
