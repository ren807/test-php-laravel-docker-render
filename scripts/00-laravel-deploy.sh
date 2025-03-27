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

#DBを破壊する
echo "Running migrate"
php artisan migrate:fresh --force

# 強制的にseederを流す
echo "Running seeder"
php artisan db:seed --class=TagSeeder --force
php artisan db:seed --class=UserSeeder --force

# npm依存関係インストール
echo "Installing npm dependencies..."
npm i

# ビルドを実行
echo "Starting Vite build..."
npm run build
