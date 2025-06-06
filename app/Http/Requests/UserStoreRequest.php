<?php
/**
 * @file UserStoreRequest.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 18:56
 *
 */

namespace App\Http\Requests;

use App\Rules\PasswordRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
     * @return array<string, array<int, string|Password>|array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => PasswordRules::confirmed(),
        ];
    }
}
