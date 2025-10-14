<?php

namespace Database\Seeders;

use App\Models\Database\v1\Category;
use App\Models\Database\v1\Product;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(10)->create()->each(function ($category) {
            // For each category, create 30 products
            Product::factory(30)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
