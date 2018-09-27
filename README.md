
# Laravel Mixmix Directive


This `@mixmix` directive can convert CDN script/css files and local files into one local file.


Before : 

```
@mixmix
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" />
<link href="/css/styles.css?{{time()}}" rel="stylesheet">
<link href="/css/main.css" rel="stylesheet" type="text/css">
@endmixmix
```

After :
 
```
<link href="/storage/mixmix/3627482dd6bd4907389e0c1fcbfce6d0.css?1537641502" rel="stylesheet" type="text/css">
```

## Install

```
composer require prexlab/laravel_mixmix
php artisan storage:link
```

## Note

- If `APP_ENV=local`, @mixmix do not convert.
- `?FORCE_MIXMIX=1` can convert forcibly. This query parameter can be changed with `FORCE_MIXMIX=hoge` in .env
- You can NOT include css file which import local file with relative link.
(such as fontawesome)
