<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('{version}/notification', [NotificationController::class, 'index'])
    ->where('version', 'v[0-9]+');

Route::post('{version}/notification', [NotificationController::class, 'store'])
    ->where('version', 'v[0-9]+');

Route::get('{version}/notification/{id}', [NotificationController::class, 'show'])
    ->where('version', 'v[0-9]+');

Route::match(['put', 'patch'], '{version}/notification/{id}', [NotificationController::class, 'update'])
    ->where('version', 'v[0-9]+');

Route::delete('{version}/notification/{id}', [NotificationController::class, 'destroy'])
    ->where('version', 'v[0-9]+');

