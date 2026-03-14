#!/bin/bash

echo "Aguardando banco de dados..."

while ! nc -z db 3306; do
  sleep 1
done

echo "Banco conectado"

if [ ! -f .env ]; then
  cp .env.example .env
fi

composer install

php artisan key:generate

php artisan migrate --force
php artisan db:seed --force

php artisan config:clear
php artisan cache:clear

chmod -R 777 storage
chmod -R 777 bootstrap/cache

php-fpm