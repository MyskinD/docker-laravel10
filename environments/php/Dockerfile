FROM php:8.2-fpm

# Copy composer.lock and composer.json
COPY ../../composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN set -eux && apt-get update && apt-get upgrade -y && apt-get install -y --no-install-recommends \
            git \
            curl \
            libmemcached-dev \
            libz-dev \
            libpq-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev \
            zip \
            unzip \
            nodejs \
            npm \
            vim

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN set -eux && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

#Configure the PHP gd library
RUN docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY ../.. /var/www

# Copy existing application directory permissions
COPY --chown=www:www ../.. /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
