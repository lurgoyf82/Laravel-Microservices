<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\GatewayController;

    /*
    |--------------------------------------------------------------------------
    | API Gateway Catch-All
    |--------------------------------------------------------------------------
    |
    | 1) Must start with “api/” (handled by this file’s prefix)
    | 2) Extracts {version}   (e.g. v1, v2, …)
    | 3) Extracts {service}   (e.g. users, orders, payment, …)
    | 4) Extracts optional {path} (anything after the service)
    | 5) Forwards to GatewayController@proxy
    |
    */

    // Catch all under /api/v1/{service}/{path?}
    Route::any('v1/', [GatewayController::class,'proxy']);
        //->where('version','v[0-9]+')
        //->where('path', '.*');

    //Route::any('v1/{service}', [GatewayController::class,'proxy']);

    //Route::any('v1/{service}/{path}', [GatewayController::class,'proxy']);
    Route::any('{version}/{service}/{parameters?}', [GatewayController::class,'proxy'])
        ->where('version', 'v[0-9]+')          // v1, v2, v12…
        ->where('service', '[A-Za-z0-9\\-]+')  // utenti, order-service…
        ->where('parameters', '.*');           // zero o più segmenti


