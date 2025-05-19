FROM php:8.2-apache

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    redis-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Instalar a extensão PHP Redis
RUN pecl install redis && docker-php-ext-enable redis

# Habilitar o mod_rewrite
RUN a2enmod rewrite

# Copiar a configuração do Apache
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
