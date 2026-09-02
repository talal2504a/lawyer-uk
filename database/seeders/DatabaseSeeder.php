<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Specialization;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@lawyerconnect.com',
            'password' => Hash::make('admin123'),
            'mobile' => '03001234567',
            'city' => 'Lahore',
            'user_type' => 'admin',
            'status' => 'active',
        ]);

        // Create default specializations
        $specializations = [
            'Criminal Law',
            'Family Law',
            'Civil Law',
            'Property Law',
            'Corporate Law',
            'Taxation Law',
            'Constitutional Law',
            'Labor Law',
            'Cyber Crime',
            'Intellectual Property',
        ];

        foreach ($specializations as $spec) {
            Specialization::create([
                'name' => $spec,
                'status' => 'active',
            ]);
        }
    }
}