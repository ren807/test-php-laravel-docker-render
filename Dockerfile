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
RUN apk update && apk add --no-cache bash curl npm

# Node.jsのインストール
RUN apk add --no-cache nodejs

# Node.jsの動作確認
RUN node -v

# # 必要な依存関係のインストール
# RUN npm install

# # フロントエンドのビルド
# RUN npm run build

CMD ["/start.sh"]
