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

        DB::table('panel_roles')->insert([
            'id' => 2,
            'unique' => Str::ulid(),
            'record_title' => 'jhpadmin',
            'panel_role' => 'jhpadmin',
            'is_active' => 1,
        ]);

        DB::table('panel_roles')->insert([
            'id' => 3,
            'unique' => Str::ulid(),
            'record_title' => 'jhp',
            'panel_role' => 'jhp',
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

        DB::table('users')->insert([
            'id' => 2,
            'unique' => Str::ulid(),
            'record_title' => 'jhp0001',
            'name' => 'JHP0001',
            'username' => 'jhp0001',
            'panel_role_id' => 2,
            'email' => 'jhp0001@mail.com',
            'password' => Hash::make('31928332'),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'unique' => Str::ulid(),
            'record_title' => 'jhp0002',
            'name' => 'JHP0002',
            'username' => 'jhp0002',
            'panel_role_id' => 2,
            'email' => 'jhp0002@mail.com',
            'password' => Hash::make('98691076'),
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'unique' => Str::ulid(),
            'record_title' => 'jhp0003',
            'name' => 'JHP0003',
            'username' => 'jhp0003',
            'panel_role_id' => 2,
            'email' => 'jhp0003@mail.com',
            'password' => Hash::make('91183446'),
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'unique' => Str::ulid(),
            'record_title' => 'jhp0004',
            'name' => 'JHP0004',
            'username' => 'jhp0004',
            'panel_role_id' => 2,
            'email' => 'jhp0004@mail.com',
            'password' => Hash::make('68113114'),
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'unique' => Str::ulid(),
            'record_title' => 'jhp0005',
            'name' => 'JHP0005',
            'username' => 'jhp0005',
            'panel_role_id' => 2,
            'email' => 'jhp0005@mail.com',
            'password' => Hash::make('74928493'),
        ]);
    }
}
