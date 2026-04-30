<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $purchasing = fake()->randomFloat(2, 5, 500);

        return [
            'name' => ucwords(fake()->words(2, true)),
            'description' => fake()->sentence(12),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'image' => 'default.jpg',
            'purchasing_price' => $purchasing,
            'selling_price' => round($purchasing * fake()->randomFloat(2, 1.1, 1.8), 2),
            'stock' => fake()->numberBetween(0, 200),
        ];
    }
}
