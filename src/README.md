# 確認テスト

## 環境構築
 dockerビルド
・git clone git@github.com:michan450/test_app.git
・docker-compose up -d --build

 laravel環境構築
・docker-compose exec php bash
・composer install


## 使用技術（実行環境）
・php:8.1-fpm
・laravel:8.6.12
・nginx:1.21.1
・mysql:8.0.26