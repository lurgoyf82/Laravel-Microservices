<?php
    /**
     * config/gateway_routes.php
     *
     * Keyed by the {service} route parameter.
     */

    return [

        // Analytics
        'analytics' => [
            'url'       => 'http://analytics-service:80/api',
            'cache_ttl'    => 3600,
            'auth'         => false,
            'rate_limit'   => 60,
        ],

        // Auth
        'auth' => [
            'url'       => 'http://auth-service:80/api',
            'cache_ttl'    => 0,
            'auth'         => false,
            'rate_limit'   => 60,
        ],

        // Catalog
        'catalog' => [
            'url'       => 'http://catalog-service:80/api',
            'cache_ttl'    => 3600,
            'auth'         => false,
            'rate_limit'   => 60,
        ],

        // JWT
        'jwt' => [
            'url'       => 'http://jwt-service:80/api',
            'cache_ttl'    => 3600,
            'auth'         => false,
            'rate_limit'   => 60,
        ],

        // Notification
        'notification' => [
            'url'       => 'http://notification-service:80/api',
            'cache_ttl'    => 3600,
            'auth'         => false,
            'rate_limit'   => 60,
        ],

        // Order (requires auth)
        'order' => [
            'url'       => 'http://order-service:80/api',
            'cache_ttl'    => 0,
            'auth'         => true,
            'rate_limit'   => 60,
        ],

        // Payment (requires auth)
        'payment' => [
            'url'       => 'http://payment-service:80/api',
            'cache_ttl'    => 0,
            'auth'         => true,
            'rate_limit'   => 60,
        ],

        // Users (caching reads, requires auth)
        'users' => [
            'url'       => 'http://user-service:80/api',
            'cache_ttl'    => 300,
            'auth'         => false,
            'rate_limit'   => 100,
        ],

    ];
