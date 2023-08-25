#!/bin/bash

php artisan config:clear
php artisan config:cache

echo "Migrating database..."
migrate="php artisan migrate"
# Run the command in a loop until it succeeds
while ! $migrate 2>/dev/null; do
    echo "Migrate failed, retrying..."
    sleep 1
done
echo "Migration done..."

echo "Seeding database..."
seed="php artisan db:seed"
# Run the command in a loop until it succeeds
while ! $seed 2>/dev/null; do
    echo "Seed failed, retrying..."
    sleep 1
done
echo "Seeding done..."

php artisan toolbox:inject
php artisan serve --host=0.0.0.0 --port=$WEBUI_PORT

