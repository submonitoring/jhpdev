<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('panel_roles')->insert([
            'id' => 1,
            'unique' => Str::ulid(),
            'record_title' => 'submonitoring',
            'panel_role' => 'submonitoring',
            'is_active' => 1,
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'unique' => Str::ulid(),
            'record_title' => 'Submonitoring',
            'name' => 'submonitoring',
            'username' => 'submonitoring',
            'panel_role_id' => 1,
            'email' => 'submonitoring@outlook.com',
            'password' => Hash::make('s3ng0n46'),
        ]);
    }
}
