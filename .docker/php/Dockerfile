FROM php:8.0-apache

# Update package
RUN apt-get update && apt-get upgrade -y

# Activate Apache mod_rewrite
RUN a2enmod rewrite

# Install mysql and enable mysqli php driver
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get install python3 python3-pip -y

COPY python/requirement.txt /var/www/python/requirements.txt

RUN pip3 install -r /var/www/python/requirements.txt

RUN python3 -m nltk.downloader -d /var/www/nltk_data stopwords punkt