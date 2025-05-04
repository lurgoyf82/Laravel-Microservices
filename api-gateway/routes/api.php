<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\GatewayController;

Route::middleware('gateway')
     ->any('/{path}', [GatewayController::class, 'proxy'])
     ->where('path', '.*');
