<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JWTMiddleware;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(JWTMiddleware::class);
});

// Esempio di rotta protetta
Route::get('profile', function (Illuminate\Http\Request $request) {
    $payload = $request->attributes->get('jwt_payload');
    return response()->json(['user' => $payload]);
})->middleware(JWTMiddleware::class);
