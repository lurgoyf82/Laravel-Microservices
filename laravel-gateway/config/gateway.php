<?php

return [
    'services' => [
        'auth'         => env('AUTH_SERVICE_URL',         'http://auth-service:8001'),
        'catalog'      => env('CATALOG_SERVICE_URL',      'http://catalog-service:8002'),
        'order'        => env('ORDER_SERVICE_URL',        'http://order-service:8003'),
        'payment'      => env('PAYMENT_SERVICE_URL',      'http://payment-service:8004'),
        'user'         => env('USER_SERVICE_URL',         'http://user-service:8005'),
        'analytics'    => env('ANALYTICS_SERVICE_URL',    'http://analytics-service:8006'),
        'notification' => env('NOTIFICATION_SERVICE_URL', 'http://notification-service:8007'),
    ],
];
