FROM docker.netrtl.com/php:7.3-apache-debian

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY root/ /var/www/html/

RUN echo "setup users" \
    && useradd -u 1000 vagrant \
    && usermod -aG vagrant www-data

RUN echo "configure webserver" \
    && a2enmod headers \
    && a2enmod rewrite \
    && if [ -d /var/www/html/var ]; then chmod 0755 -R /var/www/html/icons ; fi \
    && if [ -d /var/www/html/var ]; then chown www-data:www-data -R /var/www/html/icons ; fi
    && if [ -d /var/www/html/var ]; then chmod 0644 -R /var/www/html/icons/.* ; fi \
    && if [ -d /var/www/html/var ]; then chown www-data:www-data -R /var/www/html/icons/.* ; fi


VOLUME /var/www/html

WORKDIR /var/www/html