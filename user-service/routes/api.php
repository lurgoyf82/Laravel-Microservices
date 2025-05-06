<?php

    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/test', function () {
        return response()->json(['message' => 'Hello world!']);
    });

    Route::post('/register', [UserController::class, 'register']);
    Route::get('/register', [UserController::class, 'cacchio']);
    Route::post('/login', [UserController::class, 'login']);
    Route::delete('users/{id?}', [UserController::class, 'cacchio']);
    Route::get('users/{id?}', [UserController::class, 'cacchio']);
    Route::post('users/{id?}', [UserController::class, 'cacchio']);
