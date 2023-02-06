#!/bin/sh

echo "App mode: $APP_MODE"

if [ "$APP_MODE" == "development" ]
    then
        cp .env.example .env
fi

npm start