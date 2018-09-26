
# Laravel mixmix directive

こんな機能です。

https://qiita.com/puchida/items/c7c0ea9ca7cd62268d3b

## ファイル構成

```

├── README.md #このファイル
├── app
│   └── Providers
│       └── BladeServiceProvider.php #directive定義
├── resources
│   └── views
│       └── components
│           └── mixmix.blade.php #component定義
└── storage
    └── app
        └── public
            └── mixmix #保存ディレクトリ
                └── index.html
```

# 導入手順

## 上記ファイル＆ディレクトリを配置

## storage を public に

```
php artisan storage:link
```

## config/app.php にプロバイダ追加

config/app.php の providers 配列に下記を追加

    'providers' => [ 
        App\Providers\BladeServiceProvider::class,
    ]


## bladeコード内で @mixmixを使う


```
@mixmix
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link href="/css/styles.css?{{time()}}" rel="stylesheet">

<link href="/css/animate.css" rel="stylesheet" type="text/css">
<link href="/css/main.css" rel="stylesheet" type="text/css">
@endmixmix
```