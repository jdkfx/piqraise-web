# Piqraise

## 環境について

### Docker
Docker version 20.10.5

### PHP
PHP 7.4.16 (cli)

### Laravel
Laravel Framework 8.33.1

### composer
Composer version 2.0.11

## Getting Started

### リポジトリをクローン
```
$ git clone
```

### Dockerコンテナの立ち上げ
```
$ docker-compose build
$ docker-compose up -d
$ docker ps
```

### コンテナに接続
```
$ docker exec -it laravel_app bash
```
  
### プロジェクトに移動
```
# cd piqraise
```

### composer の利用
```
# composer install
# composer update
```

### .env の設定
```
# cp .env.example .env
# php artisan key:generate
```