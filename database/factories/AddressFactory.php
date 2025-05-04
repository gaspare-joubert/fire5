<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2' => fake()->boolean(30) ?
                fake()->randomElement(['Apt.', 'Suite', 'Unit']) . ' ' . fake()->numberBetween(100, 999) : null,
            'city'           => fake()->city(),
            'postcode'       => fake()->postcode(),
        ];
    }
}
