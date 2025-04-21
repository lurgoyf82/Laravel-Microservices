<?php

return [
    'services' => [
        'auth'    => env('AUTH_SERVICE_URL', 'http://auth-service:8000/api/auth'),
        'catalog' => env('CATALOG_SERVICE_URL', 'http://catalog-service:8000/api/catalog'),
        'order'   => env('ORDER_SERVICE_URL', 'http://order-service:8000/api/order'),
        'payment' => env('PAYMENT_SERVICE_URL', 'http://payment-service:8000/api/payment'),
        'user'    => env('USER_SERVICE_URL', 'http://user-service:8000/api/user'),
    ],
];
