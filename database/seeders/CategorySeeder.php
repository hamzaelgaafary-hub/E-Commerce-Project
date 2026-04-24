<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create();
        Category::factory()->create([
            'name' => 'Electronics',
            'description' => 'Electronic gadgets and devices',
        ]);
        Category::factory()->create([
            'name' => 'Clothing',
            'description' => 'Apparel and fashion items',
        ]);
        Category::factory()->create([
            'name' => 'Home & Kitchen',
            'description' => 'Household items and kitchenware',
        ]);
        Category::factory()->create([
            'name' => 'Books',
            'description' => 'Books and literature',
        ]);
        Category::factory()->create([
            'name' => 'Sports & Outdoors',
            'description' => 'Sporting goods and outdoor equipment',
        ]);
        Category::factory()->create([
            'name' => 'Health & Beauty',
            'description' => 'Health and beauty products',
        ]);
        Category::factory()->create([
            'name' => 'Toys & Games',
            'description' => 'Toys and games for all ages',
        ]);
        Category::factory()->create([
            'name' => 'Automotive',
            'description' => 'Automotive parts and accessories',
        ]); 
        Category::factory()->create([
            'name' => 'Garden & Outdoor',
            'description' => 'Garden tools and outdoor furniture',
        ]);
        Category::factory()->create([
            'name' => 'Office Supplies',
            'description' => 'Office supplies and stationery',
        ]);
    }
}
