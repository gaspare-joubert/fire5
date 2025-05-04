<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 4 regular unverified users with known password
        User::factory()->count(4)->unverified()->state(
            [
                'password' => Hash::make('password')
            ]
        )->create();

        // Create 1 admin unverified user with known password
        User::factory()->unverified()->state(
            [
                'is_admin' => true,
                'password' => Hash::make('adminpassword'),
                'email'    => 'admin@example.com' // Optional: set a predictable email
            ]
        )->create();
    }
}
