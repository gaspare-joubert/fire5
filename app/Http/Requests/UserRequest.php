<?php
/**
 * @file UserRequest.php
 *
 * @author Gaspare Joubert
 * @date 04/05/2025 20:10
 *
 */

namespace App\Http\Requests;

use App\Rules\PasswordRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Handles both PUT (full update) and PATCH (partial update).
     *
     * Ensure this email is unique in the users table's email column, EXCEPT for the record with the ID that matches
     * the current user being edited.
     *
     * @return array<string, array<int, string|Password>>
     */
    public function rules(): array
    {
        if ($this->method() === 'put') {
            return [
                'name'              => ['required', 'string', 'max:255'],
                'email'             => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email,' . $this->route('id')
                ],
                'email_verified_at' => ['required', 'date'],
                'password'          => PasswordRules::default(),
                'remember_token'    => ['required', 'string', 'max:100'],
                'is_admin'          => ['required', 'boolean'],
            ];
        }

        // PATCH request rules
        return [
            'name'              => ['sometimes', 'string', 'max:255'],
            'email'             => [
                'sometimes',
                'email',
                'max:255',
                'unique:users,email,' . $this->route('id')
            ],
            'email_verified_at' => ['sometimes', 'nullable', 'date'],
            'password'          => PasswordRules::update(),
            'remember_token'    => ['sometimes', 'nullable', 'string', 'max:100'],
            'is_admin'          => ['sometimes', 'boolean'],

            // Address validation rules
            'address_line_1'    => ['required', 'string', 'max:255'],
            'address_line_2'    => ['sometimes', 'nullable', 'string', 'max:255'],
            'city'              => ['required', 'string', 'max:255'],
            'postcode'          => ['required', 'string', 'max:20'],
        ];
    }
}
