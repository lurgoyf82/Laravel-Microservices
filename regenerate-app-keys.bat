@echo off

echo Regenerating keys for analytics-service ...
php analytics-service/artisan key:generate
php analytics-service/artisan jwt:secret

echo Regenerating keys for catalog-service ...
php catalog-service/artisan key:generate
php catalog-service/artisan jwt:secret

echo Regenerating keys for laravel-auth-service ...
php laravel-auth-service/artisan key:generate
php laravel-auth-service/artisan jwt:secret

echo Regenerating keys for laravel-gateway-service ...
php laravel-gateway-service/artisan key:generate
php laravel-gateway-service/artisan jwt:secret

echo Regenerating keys for notification-service ...
php notification-service/artisan key:generate
php notification-service/artisan jwt:secret

echo Regenerating keys for order-service ...
php order-service/artisan key:generate
php order-service/artisan jwt:secret

echo Regenerating keys for payment-service ...
php payment-service/artisan key:generate
php payment-service/artisan jwt:secret

echo Regenerating keys for user-service ...
php user-service/artisan key:generate
php user-service/artisan jwt:secret

echo Done!
pause
