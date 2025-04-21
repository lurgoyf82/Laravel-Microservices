<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\GatewayController;

    Route::middleware(['cors', 'throttle:60,1'])
        ->prefix('api')
        ->group(function () {

            // tutte le rotte pubbliche verso i microservizi:
            Route::any('/auth-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'auth-service');

            Route::any('/catalog-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'catalog-service');

            Route::any('/order-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'order-service');

            Route::any('/payment-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'payment-service');

            Route::any('/user-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'user-service');

            Route::any('/notification-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'notification-service');

            Route::any('/analytics-service/{path?}', [GatewayController::class, 'proxy'])
                ->where('path', '.*')
                ->defaults('service', 'analytics-service');

            // esempi di rotte protette da JWT
            Route::middleware('jwt')->group(function () {
                Route::any('/auth-service-jwt/{path?}', [GatewayController::class, 'proxy'])
                    ->where('path', '.*')
                    ->defaults('service', 'auth-service');

                Route::any('/catalog-service-jwt/{path?}', [GatewayController::class, 'proxy'])
                    ->where('path', '.*')
                    ->defaults('service', 'catalog-service');
            });

        });
