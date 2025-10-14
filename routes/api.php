<?php declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::get('products', \App\Http\Controllers\API\Product\ProductListApiController::class);
Route::patch('/product/{id}', \App\Http\Controllers\API\Product\ProductUpdateApiController::class );
