#!/bin/bash

composer update

echo "App mode: $APP_MODE"
echo "Refresh migrations: $REFRESH_MIGRATIONS"

if [ "$APP_MODE" == "development" ]; then
    cp .env.example .env
    cp .env.testing.example .env.testing

    if [ "$REFRESH_MIGRATIONS" == "true" ]; then
        php artisan migrate:fresh
        php artisan db:seed
        php artisan migrate:fresh --env=testing
    fi
fi

php artisan serve --host 0.0.0.0