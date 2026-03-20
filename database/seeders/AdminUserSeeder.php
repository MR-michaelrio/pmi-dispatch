<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
        ['email' => 'admin@pmi.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
        );

        if ($admin->wasRecentlyCreated) {
            Log::info('Admin user created successfully.');
            $this->command->info('Admin user created successfully.');
        }
        else {
            Log::info('Admin user already exists.');
            $this->command->info('Admin user already exists.');
        }
    }
}