<?php
/**
 * @file UserService.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 19:09
 *
 */

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * Create a new user
     */
    public function store(array $data): ?User
    {
        try {
            return User::create([
                                    'name'     => $data['name'],
                                    'email'    => $data['email'],
                                    'password' => Hash::make($data['password']),
                                ]);
        } catch (\Exception $e) {
            // Create a safe version of data without the password
            $safeData = $data;
            unset($safeData['password']);

            Log::error('Failed to create user', [
                'data'      => $safeData,
                'exception' => $e->getMessage()
            ]);

            return null;
        }
    }

    /**
     * Get a user by ID
     */
    public function getById(int|null|string $id): ?User
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve user', [
                'id'        => $id,
                'exception' => $e->getMessage()
            ]);

            return null;
        }
    }

    /**
     * Get a user by email and password.
     */
    public function getByEmailAndPassword(string $email, string $password): ?User
    {
        try {
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Failed to retrieve user', [
                'email'     => $email,
                'exception' => $e->getMessage()
            ]);

            return null;
        }
    }
}
