FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-scripts

COPY . .

RUN chmod +x docker/entrypoint.sh

ENTRYPOINT ["/bin/sh", "docker/entrypoint.sh"]

CMD ["php-fpm"]
