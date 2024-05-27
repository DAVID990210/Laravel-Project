<?php

namespace Database\Seeders;

USE App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$MsuvDxWhqNR4nRXWGOLcFuYy9i6N7Sr6Me6yxqIT5YCFMXFLRjZ/G',
            'remember_token' => Str::random(10),
        ])->assignRole('admin');
    }
}
