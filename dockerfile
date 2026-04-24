FROM php:8.2-cli

# Systeem pakketten
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip

# Composer installeren
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# App kopiëren
WORKDIR /app
COPY . .

# Symfony dependencies installeren
RUN composer install

# Poort
EXPOSE 10000

# Start commando
CMD php -S 0.0.0.0:10000 -t public