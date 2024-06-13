<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    static ?string $dummyImage = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // TODO: Check if 'storage/app/public/images' exists if not, create it
        if (static::$dummyImage == null) static::$dummyImage = fake()->image('storage/app/public/images', 100, 50, null, false, true, 'dummy');
        return [
            'title' => fake()->words(fake()->numberBetween(2, 5), true),
            'image' => static::$dummyImage,
            'text' => fake()->realText(),
            'is_active' => true,
        ];
    }
}
