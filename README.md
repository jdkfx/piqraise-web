# GTP

## 環境について

### PHP
PHP 8.0.0 (cli)

### Laravel
Laravel Framework 8.27.0

### composer
Composer version 2.0.9

## Getting Started

### リポジトリをクローン
```
$ git clone git@github.com:psbss/gtp.git
```
  
### プロジェクトに移動
```
$ cd gtp/app
```

### composer の利用
```
$ composer install
$ composer update
```

### .env の設定
```
$ cp .env.example .env
$ php artisan key:generate
```

### Homestead を app/ にインストール
```
$ composer require laravel/homestead --dev
```

### homestead.yaml を作成
```
// macOS／Linux
$ php vendor/bin/homestead make
```
or
```
// Windows
$ vendor\bin\homestead make
```

### Homestead.yaml を編集
```
ip: 192.168.10.12

// ...

sites:
    -
        map: gtp.test
        to: /home/vagrant/code/public
databases:
    - gtp
```

### etc/hosts
```
# 下記を追加
192.168.10.12		gtp.test
```

### vagrant up
```
$ vagrant up --provision
```
[http://gtp.test/](http://gtp.test/)にアクセス