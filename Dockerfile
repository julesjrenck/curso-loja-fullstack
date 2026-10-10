FROM php:8.4.26-cli-bookworm

COPY --from=composer/composer:2.10.3-bin /composer /usr/local/bin/composer

WORKDIR /app

COPY src/ ./

CMD ["php", "index.php"]
