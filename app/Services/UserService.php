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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
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
        } catch (\Throwable $e) {
            // Create a safe version of data without the password
            $safeData = $data;
            unset($safeData['password']);

            Log::error('Failed to create user', [
                'data'      => $safeData,
                'exception' => $e->getMessage(),
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
            return User::with(['address', 'contacts', 'files'])->findOrFail($id);
        } catch (\Throwable $e) {
            Log::error('Failed to retrieve user', [
                'id'        => $id,
                'exception' => $e->getMessage(),
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
        } catch (\Throwable $e) {
            Log::error('Failed to retrieve user', [
                'email'     => $email,
                'exception' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Get all users with pagination
     */
    public function getAllUsers(int $perPage = 15): ?LengthAwarePaginator
    {
        try {
            return User::with(
                [
                    'address',
                    'contacts' => function ($query) {
                        $query->orderBy('name', 'asc');
                    },
                    'files'    => function ($query) {
                        $query->orderBy('original_name', 'asc');
                    }
                ]
            )->paginate($perPage);
        } catch (\Throwable $e) {
            Log::error('Failed to retrieve users', [
                'perPage'   => $perPage,
                'exception' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Update the specified user with an array of field-value pairs.
     *
     * @param array $data Associative array of field-value pairs to update
     */
    public function update(string $id, array $data): ?User
    {
        try {
            $user = User::with(
                [
                    'address',
                    'contacts' => function ($query) {
                        $query->orderBy('name', 'asc');
                    },
                    'files'    => function ($query) {
                        $query->orderBy('original_name', 'asc');
                    }
                ]
            )->findOrFail($id);

            // Handle special fields that need processing before update
            $this->processSpecialFields($data);

            // Perform the update with all field-value pairs
            $user->update($data);
            if ($user->address) {
                $user->address->update($data);
            } else {
                // Create a new address for the user
                $user->address()->create($data);
            }

            return $user;

        } catch (ModelNotFoundException|\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                Log::info('User not found during update: ', [
                    'user_id' => $id,
                ]);
            } else {
                // Create a safe version of data without the password
                $safeData = $data;
                unset($safeData['password']);

                Log::error('Failed to update user', [
                    'data'      => $safeData,
                    'exception' => $e->getMessage(),
                ]);
            }

            return null;
        }
    }

    /**
     * Process special fields that need transformation before update.
     */
    private function processSpecialFields(array &$data): void
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
    }
}
