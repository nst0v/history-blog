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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'avatar' => fake()->optional(0.3)->imageUrl(200, 200, 'people'),
            'bio' => fake()->optional(0.7)->paragraph(2),
            'role' => fake()->randomElement(['user', 'author', 'admin']),
            'is_active' => fake()->boolean(90), // 90% активных
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function author(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'author',
            'is_active' => true,
            'bio' => 'Историк, специализирующийся на ' . fake()->randomElement([
                'древней истории',
                'средневековье',
                'новом времени',
                'военной истории',
                'археологии'
            ]),
        ]);
    }
}
