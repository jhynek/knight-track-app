FROM nginx:1.22

RUN rm -f /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/nginx.conf

COPY ./.docker/nginx/includes /etc/nginx/includes
COPY ./.docker/nginx/conf.d /etc/nginx/conf.d
COPY ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./www /media/src/knight-track/www

EXPOSE 80
