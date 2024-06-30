<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        return [
            'email' => 'roma2003kezik7@mail.ru',
            'created_at' => '2024-05-10 15:57:50',
            'phone_number' => '+375445963188',
            'password' => '$2y$12$zRsLU.kVoAzcfQY9w4aIWeqTsHqXiV6NTDK8anhxc1zdWC9DPh3CO',
            'remember_token' => 'token1',
            'updated_at' => '2024-05-10 18:56:05',
            'email_verified_at' => '2024-05-10 18:56:05',
            'user_type' => '1',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => date_create(now()),
        ]);
    }
}
