FROM docker.netrtl.com/php:7.3-apache-debian

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html/

RUN echo "setup users" \
    && useradd -u 1000 vagrant \
    && usermod -aG vagrant www-data

RUN echo "configure webserver" \
    && a2enmod headers \
    && a2enmod rewrite

WORKDIR /var/www/html
