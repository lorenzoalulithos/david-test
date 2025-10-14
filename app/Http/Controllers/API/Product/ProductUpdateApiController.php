<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Database\v1\Category;
use App\Models\Database\v1\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductUpdateApiController extends Controller
{
    public function __invoke(ProductUpdateRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($request->filled('name')) {
                $product->name = $request->name;
            }
            if ($request->filled('color')) {
                $product->color = $request->color;
            }

            if ($request->filled('category_id')) {
                $category = Category::findOrFail($request->category_id);
                $product->category()->associate($category);
            }

            $product->save();

            return response()->json($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

    }
}
