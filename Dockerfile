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
RUN curl -fsSL https://nodejs.org/dist/v22.14.0/node-v22.14.0-linux-x64.tar.xz -o /tmp/node.tar.xz && \
    mkdir -p /usr/local/node && \
    tar -xJf /tmp/node.tar.xz -C /usr/local/node --strip-components=1 && \
    rm /tmp/node.tar.xz

# Node.jsのパスを環境変数に追加
ENV PATH="/usr/local/node/bin:$PATH"

# Node.jsの動作確認
RUN node -v && npm -v

# 必要な依存関係のインストール
RUN npm install

# フロントエンドのビルド
RUN npm run build

CMD ["/start.sh"]
