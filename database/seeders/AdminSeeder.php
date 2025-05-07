<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['super admin', 'admin', 'manager'];

        foreach ($names as $name) {
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name . '@example.com', // Correct email generation
                'password' => Hash::make('password'), // You can change this to a secure password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
