FROM php:8.2-apache

# Habilitar o mod_rewrite
RUN a2enmod rewrite

# Copiar a configuração do Apache
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
