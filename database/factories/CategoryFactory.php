<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Food',
                'Sweets',   
                'Electronics',
                'Clothing',
                'Books',
                'Toys & Games',
                'Cars & Bikes',
                'Home & Garden',
                'Sports & Outdoors',
                'Beauty & Personal Care',
                'Baby Products',
                'Pet Supplies',
                'Office Supplies',
                'Grocery & Gourmet Food'
            ]),
            
            'description' => $this->faker->sentence(),
        ];
    }
}
