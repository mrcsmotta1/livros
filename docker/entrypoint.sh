#!/bin/bash
set -e

echo "🚀 Iniciando container Laravel..."

# Garante que pastas de cache e log existam
mkdir -p /app/storage/framework/{cache,sessions,views} /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Limpa e otimiza o Laravel
php artisan optimize:clear || true
php artisan config:cache || true

# Continua com o comando original do container (php-fpm)
exec "$@"
