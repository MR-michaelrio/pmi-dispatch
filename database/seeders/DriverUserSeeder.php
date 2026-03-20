<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class DriverUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create driver user
        $user = User::create([
            'name' => 'Driver Test',
            'email' => 'driver@test.com',
            'password' => Hash::make('password'),
            'role' => 'driver',
        ]);

        // Create driver record
        Driver::create([
            'name' => 'Driver Test',
            'phone' => '081234567890',
            'license_number' => 'DRV001',
            'status' => 'available',
        ]);
    }
}
