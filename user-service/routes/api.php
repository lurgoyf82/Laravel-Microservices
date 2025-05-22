<?php

    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/test', function () {
        return response()->json(['message' => 'Hello world!']);
    });

    Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::apiResource('users', UserController::class)->except(['store']);
