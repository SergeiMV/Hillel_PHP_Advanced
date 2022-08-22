## Install dependencies

```
docker run --rm --interactive --tty --volume $(pwd):/app composer install
```

## Start apache, mysql and composer from docker

```
docker-compose up
```

## Start laravel developer server

```
php artisan serve
```

## Make migrations

```
php artisan migrate:refresh
```

## Seed your database

```
php artisan db:seed
```

## Run code sniffer

```
docker run --rm -v $(pwd):/data cytopia/phpcs --standard=PSR12 app database routes

```

## Run jobs scheduler

```
php artisan schedule:work

```

## Postman collaction

```
You can import postman collaction from file "postmanCollaction.json"

```


