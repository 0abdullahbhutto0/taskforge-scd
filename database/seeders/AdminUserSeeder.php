<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminExists = User::where('email', 'admin@taskforge.com')->exists();
        
        if (!$adminExists) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@taskforge.com',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]);

            $adminRole = Role::where('name', 'Admin')->first();
            if ($adminRole) {
                $admin->roles()->attach($adminRole->id);
            }

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@taskforge.com');
            $this->command->info('Password: password');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
