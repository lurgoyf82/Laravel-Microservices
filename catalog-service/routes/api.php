<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\CatalogController;

Route::prefix('{version}')
    ->where('version', 'v[0-9]+')
    ->group(function () {
        Route::get('items', [CatalogController::class, 'index']);
        Route::get('items/{id}', [CatalogController::class, 'show']);
        Route::post('items', [CatalogController::class, 'store']);
        Route::match(['put', 'patch'], 'items/{id}', [CatalogController::class, 'update']);
        Route::delete('items/{id}', [CatalogController::class, 'destroy']);
    });

