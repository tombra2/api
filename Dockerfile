FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libicu-dev libzip-dev git unzip \
    && docker-php-ext-install \
    intl \
    pdo_mysql \
    opcache \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

ENV APP_ENV=prod \
    APP_DEBUG=0

COPY composer.json composer.lock symfony.lock ./
RUN composer install -o --no-dev --no-scripts --no-interaction --no-progress --prefer-dist

COPY . .

RUN php bin/console cache:clear && chown -R www-data:www-data var
RUN chmod +x  docker/entrypoint.sh
ENTRYPOINT [ "docker/entrypoint.sh" ]
CMD ["php-fpm" ]








