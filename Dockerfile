# syntax=docker/dockerfile:1
FROM php:8.4-fpm-alpine AS base
RUN apk add --no-cache icu-libs libpq \
 && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev postgresql-dev \
 && docker-php-ext-install -j$(nproc) intl pdo_pgsql opcache \
 && apk del .build-deps
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/app

# Dev : code monté en volume, var/ dans un volume Docker.
# php-fpm tourne en root (dev uniquement) pour partager var/ avec les commandes console.
# Au démarrage, composer install est lancé automatiquement si vendor/ est absent.
FROM base AS dev
RUN printf '[www]\nuser = root\ngroup = root\n' > /usr/local/etc/php-fpm.d/zz-dev.conf
COPY docker/php/docker-entrypoint-dev.sh /usr/local/bin/docker-entrypoint-dev
RUN chmod +x /usr/local/bin/docker-entrypoint-dev
ENTRYPOINT ["docker-entrypoint-dev"]
CMD ["php-fpm", "-R"]

# Dépendances seules (couche mise en cache)
FROM base AS vendor
COPY app/composer.* app/symfony.* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-progress

# Prod : dépendances + code
FROM base AS prod
ENV APP_ENV=prod
COPY --from=vendor /var/www/app/vendor ./vendor
COPY app/ ./
RUN composer dump-autoload --classmap-authoritative --no-dev \
 && mkdir -p var && chown -R www-data:www-data var

# Serveur web
FROM nginx:1.27-alpine AS nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY app/public /var/www/app/public
