<?php

namespace App\Http\Controllers\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Database\v1\Category;
use App\Models\Database\v1\Product;

class ProductPageController extends Controller
{
    public function __invoke()
    {
        return view('products', [
            'categories' => Category::all(),
            'colors' => Product::select('color')->distinct()->get(),
        ]);
    }
}
