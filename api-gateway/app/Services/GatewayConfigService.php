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
        $path = base_path('config/gateway_routes.json');

        if (! file_exists($path)) {
            Log::error("Gateway config file not found at {$path}");
            $this->routes = [];
            return;
        }

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid JSON in gateway_routes.json: ' . json_last_error_msg());
            $this->routes = [];
            return;
        }

        // Basic validation: escludi voci malformate
        $this->routes = array_filter($data, function ($r) {
            return isset($r['path_pattern'], $r['target_service_url'], $r['cache_ttl'], $r['is_active']);
        });
    }

    public function matchRoute(string $uri): ?array
    {
        foreach ($this->routes as $route) {
            if (! $route['is_active']) {
                continue;
            }
            if (preg_match('#' . $route['path_pattern'] . '#', ltrim($uri, '/'), $matches)) {
                return array_merge($route, ['matches' => $matches]);
            }
        }
        return null;
    }
}
