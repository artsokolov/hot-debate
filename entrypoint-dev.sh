#!/bin/bash

echo "Running migrations"
php artisan migrate

echo "Running php-fpm"
php-fpm
