<?php

namespace Database\Factories;


use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //لاستدعاء القيم من قاعدة البيانات دون انتاج جديد بشرط الوجود فعلا 
        $categoryIds = Category::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->jobTitle(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'trend' => $this->faker->numberBetween(0, 1),
            'qty' => $this->faker->numberBetween(0, 100),
            'slug' => $this->faker->unique()->slug(2),
            'image' => $this->faker->image(),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => $this->faker->randomElement($userIds),
            'category_id' => $this->faker->randomElement($categoryIds),
        ];
    }
}
