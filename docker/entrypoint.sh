#!/bin/sh
set -e

php bin/console doctrine:migrations:migrate --no-interaction
php bin/console app:seed-root-user

exec php-fpm
