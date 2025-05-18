<?php

return [
    'services' => [
        // Le chiavi devono corrispondere ai nomi dei container per il proxy
        // del Gateway, altrimenti la configurazione non viene trovata.
        'auth-service'         => env('AUTH_SERVICE_URL',         'http://auth-service:8001'),
        'catalog-service'      => env('CATALOG_SERVICE_URL',      'http://catalog-service:8002'),
        'order-service'        => env('ORDER_SERVICE_URL',        'http://order-service:8003'),
        'payment-service'      => env('PAYMENT_SERVICE_URL',      'http://payment-service:8004'),
        'user-service'         => env('USER_SERVICE_URL',         'http://user-service:8005'),
        'analytics-service'    => env('ANALYTICS_SERVICE_URL',    'http://analytics-service:8006'),
        'notification-service' => env('NOTIFICATION_SERVICE_URL', 'http://notification-service:8007'),
    ],
];
