<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticsController;

Route::prefix('v1')->group(function () {
    Route::get('analytics', [AnalyticsController::class, 'index']);
    Route::post('analytics', [AnalyticsController::class, 'store']);
    Route::match(['put', 'patch'], 'analytics/{id}', [AnalyticsController::class, 'update']);
    Route::delete('analytics/{id}', [AnalyticsController::class, 'destroy']);
});
