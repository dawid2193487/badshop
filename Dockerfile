FROM php:latest
WORKDIR /code
RUN docker-php-ext-install mysqli
CMD [ "php", "-S", "0.0.0.0:8000"]