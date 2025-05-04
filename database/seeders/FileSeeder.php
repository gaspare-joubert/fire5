<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users or create users if none exist
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(3)->create();
        }

        // For each user, create 2-5 files
        $users->each(function ($user) {
            $fileCount = rand(2, 5);
            File::factory()->count($fileCount)->for($user)->create();
        });
    }
}
