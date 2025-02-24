FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# 必要なパッケージのインストール
RUN apk update && apk add --no-cache bash curl

# Node.jsのインストール (バイナリ版)
RUN curl -fsSL https://nodejs.org/dist/v16.20.2/node-v16.20.2-linux-x64.tar.xz -o /tmp/node-v16.20.2-linux-x64.tar.xz && \
    tar -xJf /tmp/node-v16.20.2-linux-x64.tar.xz -C /usr/local --strip-components=1 && \
    rm /tmp/node-v16.20.2-linux-x64.tar.xz

# Node.jsのバイナリがパスに含まれていることを確認
ENV PATH=/usr/local/bin:$PATH

CMD ["/start.sh"]
