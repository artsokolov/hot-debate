#!/bin/bash

echo "Running migrations"
php artisan migrate --force

echo "Running php-fpm"
php-fpm
