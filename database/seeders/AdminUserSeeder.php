<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@carsdekho.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@carsdekho.com',
                'mobile_no' => '+1234567890',
                'password' => Hash::make('Admin@123'),
                'status' => 'active',
                'created_by' => null,
            ]
        );

        // Assign admin role if it exists
        if (Role::where('name', 'admin')->exists()) {
            $admin->assignRole('admin');
        }

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@carsdekho.com');
        $this->command->info('Password: Admin@123');
        
        // Create additional test users
        $testUser = User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'user@test.com',
                'mobile_no' => '+1234567891',
                'password' => Hash::make('Test@123'),
                'status' => 'active',
                'created_by' => null,
            ]
        );

        $this->command->info('Test user created successfully!');
        $this->command->info('Email: user@test.com');
        $this->command->info('Password: Test@123');
    }
}
