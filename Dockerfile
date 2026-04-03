FROM dunglas/frankenphp:php8.2.30-bookworm

WORKDIR /app

# Install required PHP extensions
RUN install-php-extensions \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    mbstring \
    openssl \
    pcre \
    pdo \
    session \
    tokenizer \
    xml

# Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Cache Laravel configuration, events, routes, and views
RUN php artisan config:cache \
    && php artisan event:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80

ENTRYPOINT ["frankenphp", "php-server", "--listen", ":80", "--root", "/app/public"]
