FROM php:8.2-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    curl zip unzip git libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod +x start.sh

EXPOSE 10000

CMD ["bash", "start.sh"]