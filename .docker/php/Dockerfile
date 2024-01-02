FROM php:8.0-apache

# Update package
RUN apt-get update && apt-get upgrade -y

# Activate Apache mod_rewrite
RUN a2enmod rewrite

# Install mysql and enable mysqli php driver
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
