<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@hcitsol.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@hcitsol.com',
                'password' => Hash::make('Admin@123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a secondary admin user (optional)
        User::updateOrCreate(
            ['email' => 'superadmin@hcitsol.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@hcitsol.com',
                'password' => Hash::make('SuperAdmin@123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('-----------------------------------');
        $this->command->info('Admin 1: admin@hcitsol.com / Admin@123');
        $this->command->info('Admin 2: superadmin@hcitsol.com / SuperAdmin@123');
        $this->command->info('-----------------------------------');
    }
}
