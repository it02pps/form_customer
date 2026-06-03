FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libonig-dev \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip gd

WORKDIR /var/www/html

COPY . .

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]