FROM php:8.3-fpm AS build
RUN rm -rf /var/www/*
USER root

ENV PHP_INI_DIR /usr/local/etc/php

ENV OPCACHE_ENABLED="0"
COPY ./.docker/app/php.ini $PHP_INI_DIR/php.ini
COPY ./.docker/app/php-docker.ini /usr/local/etc/php-fpm.d/docker.conf
COPY ./.docker/app/entrypoint.sh /usr/local/bin/
RUN chmod 755 /usr/local/bin/entrypoint.sh

RUN sed -i -e "s/pm.max_children = 5/pm.max_children = 40/g" /usr/local/etc/php-fpm.d/www.conf && \
        sed -i -e "s/pm.start_servers = 2/pm.start_servers = 4/g" /usr/local/etc/php-fpm.d/www.conf && \
        sed -i -e "s/pm.min_spare_servers = 1/pm.min_spare_servers = 2/g" /usr/local/etc/php-fpm.d/www.conf && \
        sed -i -e "s/;clear_env = no/clear_env = no/g" /usr/local/etc/php-fpm.d/www.conf && \
        sed -i -e "s/pm.max_spare_servers = 3/pm.max_spare_servers = 6/g" /usr/local/etc/php-fpm.d/www.conf

RUN apt-get update && apt-get install -y \
    iputils-ping \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    libpq-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-enable pdo_pgsql

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd opcache


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --chown=www-data:www-data . /var/www

WORKDIR /var/www
ARG GITHUB_AUTH_TOKEN=$GITHUB_AUTH_TOKEN

RUN echo $GITHUB_AUTH_TOKEN
RUN composer config --global github-oauth.github.com $GITHUB_AUTH_TOKEN

RUN apt-get update && apt-get install -y nodejs npm
RUN npm ci





FROM build AS dev

RUN composer install --no-dev --optimize-autoloader && composer clearcache
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

FROM build AS prod

RUN composer install --no-dev --optimize-autoloader && composer clearcache
ENV OPCACHE_ENABLED="1"
RUN npm run build
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
