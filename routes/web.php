<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;


Route::get('/products', \App\Http\Controllers\Pages\Product\ProductPageController::class);
