#!/bin/bash

composer install
php artisan migrate --force
php artisan db:seed --force
php artisan toolbox:inject
php artisan config:clear
php artisan config:cache
php artisan serve --host=0.0.0.0 --port=$WEBUI_PORT

