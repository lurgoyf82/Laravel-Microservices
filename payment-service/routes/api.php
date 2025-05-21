<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::prefix('v1')->group(function () {
    Route::apiResource('payment', PaymentController::class);
});
