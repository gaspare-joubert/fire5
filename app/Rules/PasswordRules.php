<?php

namespace App\Rules;

use Illuminate\Validation\Rules\Password;

class PasswordRules
{
    /**
     * Get the base password rule that's used everywhere.
     */
    private static function baseRule(): Password
    {
        return Password::min(12)->letters()->mixedCase()->numbers()->symbols()->uncompromised();
    }

    /**
     * The default required password rules.
     *
     * @return array<int, string|Password>
     */
    public static function default(): array
    {
        return [
            'required',
            'string',
            self::baseRule(),
        ];
    }

    /**
     * The confirmed password rules.
     *
     * @return array<int, string|Password>
     */
    public static function confirmed(): array
    {
        return [
            'required',
            'string',
            'confirmed',
            self::baseRule(),
        ];
    }

    /**
     * The password rules for updating a user's password.
     *
     * @return array<int, string|Password>
     */
    public static function update(): array
    {
        return [
            'nullable',
            'string',
            self::baseRule(),
        ];
    }
}
