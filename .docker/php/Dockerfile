FROM php:8.0-apache

ARG NODE_VERSION=20

# Update package
RUN apt-get update \
    && apt-get install -y ca-certificates curl gnupg python3 python3-pip \
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && PLAYWRIGHT_BROWSERS_PATH=/var/www/.cache/ms-playwright npx playwright install chromium

# Activate Apache mod_rewrite
RUN a2enmod rewrite

# Install mysql and enable mysqli php driver
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get install  -y

COPY python/requirement.txt /var/www/python/requirements.txt

RUN pip3 install -r /var/www/python/requirements.txt \
    && python3 -m nltk.downloader -d /var/www/nltk_data stopwords punkt