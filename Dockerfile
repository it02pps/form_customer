FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libonig-dev \
    git \
    && docker-php-ext-install pdo_mysql mbstring zip

WORKDIR /var/www/html

COPY . .

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]