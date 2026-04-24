<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\category;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(6),
            "quote" => fake()->sentence(1),
            "content" => fake()->paragraph(10),
            "slug" => fake()->slug(),
            "image" => fake()->imageUrl(640, 480, 'blog', true),
            "category_id" => category::inRandomOrder()->first()?->id ?? category::factory(),
            "user_id" => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
