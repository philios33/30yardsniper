FROM wordpress:php8.1-apache

RUN apt-get update && apt-get install less

WORKDIR /var/www

# Copy a php.ini file to set the max file upload settings
COPY php.ini /usr/local/etc/php/conf.d/additional.ini

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x /var/www/wp-cli.phar
RUN chown www-data:www-data /var/www/wp-cli.phar
RUN echo "path: html/" > wp-cli.yml

WORKDIR /var/www/html