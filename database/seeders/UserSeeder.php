<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed superadmin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@atmi.com',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed admin users for each plant
        $plants = ['MDC', 'WF', 'MN'];
        foreach ($plants as $plant) {
            DB::table('users')->insert([
                'name' => ucfirst(strtolower($plant)) . ' admin',
                'email' => strtolower($plant) . '@atmi.com',
                'role' => 'admin',
                'plant' => $plant,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@atmi.com',
            'role' => 'user',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // You can add more user seeds here if needed
    }
}
