FROM debian:bullseye

RUN mkdir -p /run/php

COPY .docker/php-fpm/install.sh /root/

RUN \
    chmod +x /root/install.sh &&\
    sync &&\
    /root/install.sh \

COPY .docker/php-fpm/conf/php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf
COPY .docker/php-fpm/conf/fpm-app.conf /etc/php/8.1/fpm/pool.d/www.conf
COPY .docker/php-fpm/conf/99-xdebug.ini /etc/php/8.1/fpm/conf.d/99-xdebug.ini

EXPOSE 9000


CMD [ "bash", "-c", "tail -f /dev/null"]


COPY .docker/php-fpm/start.sh /start.sh
RUN chmod +x /start.sh
CMD /start.sh
