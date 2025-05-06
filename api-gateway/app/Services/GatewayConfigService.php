<?php

    namespace App\Services;

    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Log;

    class GatewayConfigService
    {
        protected array $routes;

        public function __construct()
        {
            $this->routes = config('gateway_routes', []);
        }

        /**
         * @param  string  $service  the {service} route parameter
         * @return array<string,mixed>|null
         */
        public function getRoute(string $service): ?array
        {
            if (! isset($this->routes[$service])) {
                Log::warning("Gateway route not configured for service [{$service}]");
                return null;
            }

            $route = $this->routes[$service];

            // Validate minimal keys
            if (! Arr::has($route, ['target','cache_ttl','auth','rate_limit'])) {
                Log::error("Malformed gateway config for service [{$service}]");
                return null;
            }

            return $route;
        }
    }
