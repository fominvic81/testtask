<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Editor>
 */
class EditorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'password' => Hash::make('password'),
            'is_admin' => false,
        ];
    }

    public function admin(bool $value = true): Factory
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => $value
        ]);
    }
}
