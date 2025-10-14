<?php

namespace Tests\Feature\Products;

use App\Models\Database\v1\Category;
use App\Models\Database\v1\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;

    public function testProductNoFilter()
    {
        Category::factory(2)->create()->each(function ($category) {
            Product::factory(5)->create([
                'category_id' => $category->id,
            ]);
        });


        $response = $this->get('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function testProductCategoryFilter()
    {
        $categories = Category::factory(2)->create();

        Product::factory(5)->create([
            'category_id' => $categories[0]->id,
        ]);
        Product::factory(5)->create([
            'category_id' => $categories[1]->id,
        ]);

        $response = $this->get("/api/products?category_id=".$categories[0]->id);
        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function testProductColorFilter()
    {
        $categories = Category::factory(2)->create();

        Product::factory(3)->create([
            'category_id' => $categories[0]->id,
            'color' => 'black',
        ]);

        Product::factory(2)->create([
            'category_id' => $categories[0]->id,
            'color' => 'green',
        ]);

        Product::factory(1)->create([
            'category_id' => $categories[1]->id,
            'color' => 'black',
        ]);

        Product::factory(4)->create([
            'category_id' => $categories[1]->id,
            'color' => 'green',
        ]);


        $response = $this->get("/api/products?color=green");
        $response->assertStatus(200);
        $response->assertJsonCount(6);
    }
}
