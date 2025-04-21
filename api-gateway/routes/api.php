<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;

Route::middleware(['cors', 'throttle:60,1'])
     ->prefix('api')
     ->group(function () {

    // Rotte protette (JWT)
    Route::middleware('jwt')->group(function () {
        // Catalog-service
        Route::any('/catalog/{any?}', [GatewayController::class, 'proxy'])
            ->where('any', '.*')
            ->defaults('service', 'catalog');

        // Order-service
        Route::any('/order/{any?}', [GatewayController::class, 'proxy'])
            ->where('any', '.*')
            ->defaults('service', 'order');

        // (Altre rotte: payment, user...)
    });

    // Rotte pubbliche (es. registrazione, login)
    Route::any('/auth/{any?}', [GatewayController::class, 'proxy'])
        ->where('any', '.*')
        ->defaults('service', 'auth');
});
