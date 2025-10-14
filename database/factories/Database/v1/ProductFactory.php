<?php

namespace Database\Factories\Database\v1;

use App\Models\Database\v1\Category;
use App\Models\Database\v1\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $colors = ['red', 'blue', 'green', 'black', 'white', 'yellow'];

        return [
            'name' => ucfirst($this->faker->words(2, true)),
            'color' => $this->faker->randomElement($colors),
            'price' => $this->faker->randomFloat(2, 10),
            'category_id' => Category::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    protected $model = Product::class;
}
