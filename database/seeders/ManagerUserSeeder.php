<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if manager user already exists
        $managerExists = User::where('email', 'manager@taskforge.com')->exists();
        
        if (!$managerExists) {
            $manager = User::create([
                'name' => 'Manager User',
                'email' => 'manager@taskforge.com',
                'password' => Hash::make('password'),
                'status' => 'approved',
            ]);

            $managerRole = Role::where('name', 'Manager')->first();
            if ($managerRole) {
                $manager->roles()->attach($managerRole->id);
            }

            $this->command->info('Manager user created successfully!');
            $this->command->info('Email: manager@taskforge.com');
            $this->command->info('Password: password');
        } else {
            $this->command->info('Manager user already exists.');
        }
    }
}
