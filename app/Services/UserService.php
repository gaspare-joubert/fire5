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

class UserService
{
    /**
     * Create a new user
     *
     * @param array $data
     *
     * @return User
     */
    public function store(array $data): User
    {
        return User::create(
            [
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]
        );
    }
}
