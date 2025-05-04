<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GatewayConfigService;

class GatewayServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registra il servizio come singleton
        $this->app->singleton(GatewayConfigService::class, function ($app) {
            return new GatewayConfigService();
        });
    }
}
