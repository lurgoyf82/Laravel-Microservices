<?php

    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/test', function () {
        return response()->json(['message' => 'Hello world!']);
    });

    Route::prefix('v1')->group(function () {
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);

        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });
