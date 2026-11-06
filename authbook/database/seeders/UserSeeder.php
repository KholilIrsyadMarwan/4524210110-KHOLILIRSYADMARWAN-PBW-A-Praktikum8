<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin User',  'email' => 'admin@example.com',  'role' => 'admin'],
            ['name' => 'Staff User',  'email' => 'staff@example.com',  'role' => 'staff'],
            ['name' => 'Viewer User', 'email' => 'viewer@example.com', 'role' => 'viewer'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => 'password',
                    'role' => $user['role'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}