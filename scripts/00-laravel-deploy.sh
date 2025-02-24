#!/usr/bin/env bash

# Composerインストール
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

# Laravelの設定キャッシュ
echo "Caching config..."
php artisan config:cache

# Laravelのルートキャッシュ
echo "Caching routes..."
php artisan route:cache

# マイグレーション実行
echo "Running migrations..."
php artisan migrate --force

# Node.jsインストール
echo "Installing Node.js..."
curl -sL https://deb.nodesource.com/setup_16.x | bash -
apt-get install -y nodejs

# npm依存関係インストール
echo "Installing npm dependencies..."
cd /var/www/html
npm install

# jQueryのビルド
echo "Running npm build..."
npm run production
