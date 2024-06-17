<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(fake()->numberBetween(2, 5), true),
            'image' => fake()->image('storage/app/public/images', 640, 320, null, false, true, 'dummy'),
            'text' => fake()->realTextBetween(500, 2000),
            'is_active' => true,
        ];
    }
}
