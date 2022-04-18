#!/bin/bash

composer update

echo "App mode: $APP_MODE"
echo "Refresh migrations: $REFRESH_MIGRATIONS"

if [ "$APP_MODE" == "development" ] && [ "$REFRESH_MIGRATIONS" == "true" ]
    then
        cp .env.example .env
        cp .env.testing.example .env.testing

        php artisan migrate:fresh
        php artisan db:seed
        php artisan migrate:fresh --env=testing
fi

php artisan serve --host 0.0.0.0
