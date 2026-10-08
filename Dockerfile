FROM php:8.4.26-cli-bookworm

WORKDIR /app

COPY src/ ./

CMD ["php", "index.php"]
