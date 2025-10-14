<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductListRequest;
use App\Models\Database\v1\Product;

class ProductListApiController extends Controller
{
    public function __invoke(ProductListRequest $request)
    {
        $query = Product::query();

        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();


        return response()->json($products);
    }
}
