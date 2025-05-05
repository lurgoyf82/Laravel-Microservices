<?php return [
    {
        "id": "analytics_service",
        "path_pattern": "^analytics\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "user_service",
        "path_pattern": "^user\\$",
        "target_service_url": "http://user-service:80",
        "cache_ttl": 0,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "catalog_service",
        "path_pattern": "^catalog\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "jwt_service",
        "path_pattern": "^jwt\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "notification_service",
        "path_pattern": "^notification\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "order_service",
        "path_pattern": "^order\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "payment_service",
        "path_pattern": "^payment\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    },
    {
        "id": "user_service",
        "path_pattern": "^user\\/?(.*)$",
        "target_service_url": "http://product-service:80",
        "cache_ttl": 3600,
        "is_active": true,
        "auth_required": false,
        "rate_limit": 60
    }
]
