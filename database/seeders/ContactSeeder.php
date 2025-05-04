<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 contacts
        $contacts = Contact::factory(50)->create();

        // Get all users
        $users = User::all();

        // For each user, attach 3-10 random contacts
        $users->each(function ($user) use ($contacts) {
            $randomContacts = $contacts->random(rand(3, 10));
            $user->contacts()->sync($randomContacts);
        });
    }
}
