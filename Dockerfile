FROM php:8.2-apache

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Instalar a extensão PHP Redis
RUN pecl install redis && docker-php-ext-enable redis

# Habilitar o mod_rewrite
RUN a2enmod rewrite

# Copiar a configuração do Apache
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
