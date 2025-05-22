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


            /*
        'order' => [
            'url'       => 'http://order-service:80/api',
    cache:
      enabled: true
      ttl: 300          # seconds; 0 = bypass
      vary:
        headers: ["Accept-Language"]
        query:   ["*"]  # canonicalised order
        body:    false  # only allow GET caching
    auth:
      required:  true   # verify signature
      per_user:  true   # key contains user id
      per_scope: false  # add role list only if data differs by role
    rate_limit: 60      # rpm
             * */
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
