<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Tetap',
            'email' => 'admintetap@gmail.com',
            'password' => '$2y$12$rYSf2QcnHE05IPlt6bzSMu7biwt0u.WW8zNivZzQm/gc8P3yWnaw.', // hash admin123
            'role' => 'admin',
            'is_approved' => true,
        ]);

        // Staff 1
        User::create([
            'name' => 'Staff 1',
            'email' => 'staff1@gmail.com',
            'password' => '$2y$12$8WCByWyUAwnBgRgMGVt1K.nioJsraXOtVKgHERtZ/sHs73psVLWlS', // hash staff123
            'role' => 'user',
            'is_approved' => true,
        ]);

        // Staff 2
        User::create([
            'name' => 'Staff 2',
            'email' => 'staff2@gmail.com',
            'password' => '$2y$12$8WCByWyUAwnBgRgMGVt1K.nioJsraXOtVKgHERtZ/sHs73psVLWlS', // hash staff123
            'role' => 'user',
            'is_approved' => true,
        ]);

    }
}
