#!/usr/bin/env bash
set -e

# esegue le migrazioni (avanza solo se necessario)
php artisan migrate --force

# infine lascia partire Apache
exec apache2-foreground
