<?php
    namespace App\Services;

    class RouteResolver
    {
        public function __construct(
            private array $routes  // injected via service provider
        ) {}

        public function resolve(string $service): ?array
        {
            return $this->routes[$service] ?? null;
        }
    }
