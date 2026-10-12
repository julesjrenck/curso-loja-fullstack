FROM php:8.4.26-cli-bookworm

COPY --from=composer/composer:2.10.3-bin /composer /usr/local/bin/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends unzip=6.0-28+deb12u1 \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY src/ ./

CMD ["php", "index.php"]
