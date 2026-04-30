<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Electronics', 'Groceries', 'Clothing', 'Books', 'Toys',
            'Beauty', 'Sports', 'Home & Kitchen', 'Office Supplies', 'Beverages',
        ];

        foreach ($names as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
