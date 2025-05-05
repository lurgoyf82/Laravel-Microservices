<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class GatewayConfigService
{
    protected array $routes;

    public function __construct()
    {
        $this->loadConfig();
    }

    protected function loadConfig(): void
    {
        $this->routes = require config_path('gateway_routes.php');
    }

    public function matchRoute(string $uri): ?array
    {
        foreach ($this->routes as $route) {
            if (!$route['is_active']) {
                continue;
            }
            if (preg_match('#' . $route['path_pattern'] . '#', ltrim($uri, '/'), $matches)) {
                return array_merge($route, ['matches' => $matches]);
            }
        }
        return null;
    }
}
