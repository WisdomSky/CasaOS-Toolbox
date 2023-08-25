#!/bin/bash

sudo docker rmi -f casaos-toolbox
sudo rm -rf src/vendor
sudo rm -rf src/node_modules
sudo rm -f src/composer.lock
sudo rm -f src/package-lock.json
sudo rm -f src/storage/logs/laravel.log