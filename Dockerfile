FROM php:8.2-cli

WORKDIR /var/www

# Installer Node.js + npm
RUN apt-get update && apt-get install -y \
    curl zip unzip git libzip-dev libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Compiler les assets Vite
RUN npm install && npm run build

RUN chmod +x start.sh

EXPOSE 10000

CMD ["bash", "start.sh"]