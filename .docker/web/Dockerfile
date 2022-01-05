FROM alpine

ENV PYTHON_VERSION=2.7.12-r0
ENV PY_PIP_VERSION=8.1.2-r0
ENV SUPERVISOR_VERSION=3.3.1
ENV PYTHONUNBUFFERED=1
ENV ENV="/etc/profile"

RUN addgroup -g 1000 -S samhk222 && \
    adduser -u 1000 -S samhk222 -G samhk222


# adduser -h /home/john -s /bin/ash john

# USER samhk222

# Install packages and remove default server definition
RUN apk --no-cache -X http://dl-cdn.alpinelinux.org/alpine/edge/testing add sudo git php8 php8-pecl-xdebug php8-tokenizer php8-fpm php8-opcache php8-pcntl php8-posix php8-mysqli php8-json \
    php8-openssl php8-curl php8-soap php8-zlib php8-xml php8-xmlwriter php8-phar php8-pdo php8-pdo_mysql php8-intl php8-dom php8-xmlreader php8-ctype php8-session php8-simplexml \
    php8-mbstring php8-gd nginx curl php8-exif php8-zip php8-fileinfo php8-iconv php8-soap tzdata htop mysql-client \
    php8-pecl-imagick php8-pecl-redis bash

RUN rm -rf /etc/nginx/conf.d/default.conf

RUN apk add --update nodejs npm

# Install python/pip
ENV PYTHONUNBUFFERED=1
RUN apk add --update --no-cache python3 && ln -sf python3 /usr/bin/python
RUN python3 -m ensurepip
RUN pip3 install --no-cache --upgrade pip setuptools

# Configure supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN pip install supervisor

# RUN useradd --home /home/ec2-user --create-home --shell /bin/bash --comment "EC2 Default User" --uid 1000 --groups wheel ec2-user

# Symling php8 => php
RUN ln -s /usr/bin/php8 /usr/bin/php
#RUN ln -s /bin/sh /bin/bash

# Install PHP tools
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Configure nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY fpm-pool.conf /etc/php8/php-fpm.d/www.conf
COPY php.ini /etc/php8/conf.d/custom.ini


# Setup document root
RUN mkdir -p /var/www/html/laravel-arena.local/
# RUN mkdir -p  /home/.composer/cache

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
# RUN chown -R samhk222.samhk222 /var/www/html/site.local/ && \
#     chown -R samhk222.samhk222 /run && \
#     chown -R samhk222.samhk222 /var/lib/nginx && \
#     # chown -R samhk222.samhk222 /.composer/cache && \
#     chown -R samhk222.samhk222 /var/log/nginx

RUN chown -R samhk222:samhk222 /run && \
    chown -R samhk222:samhk222 /var/lib/nginx && \
    chown -R samhk222:samhk222 /var/log/nginx

# Custom aliases
RUN echo 'alias pa="php artisan "' >> "$ENV"
RUN echo 'alias pf="clear && vendor/bin/phpunit --stop-on-failure --filter="' >> "$ENV"
RUN echo 'alias nrw="npm run watch"' >> "$ENV"
RUN echo 'alias nrh="npm run hot"' >> "$ENV"

# RUN chown -R samhk222:samhk222 /var/www/html
# Switch to use a non-root user from here on

# RUN echo '%wheel ALL=(ALL) ALL' > /etc/sudoers.d/wheel
# RUN adduser samhk222 wheel

USER samhk222

# Add application
WORKDIR /var/www/html/laravel-arena.local/

# Expose the port nginx is reachable on
EXPOSE 80

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

#CMD php-fpm8 -d variables_order="EGPCS" && exec nginx -g "daemon off;"

# Configure a healthcheck to validate that everything is up&running
#HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1/fpm-ping
