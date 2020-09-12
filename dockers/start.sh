#!/usr/bin/env bash

chmod -R 777 ./bootstrap/cache
chmod -R 777 ./storage

composer update --no-interaction --optimize-autoloader --no-dev
php artisan jwt:secret
php artisan key:generate
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan migrate --force

/usr/bin/supervisord -c /etc/supervisor/supervisord.conf
