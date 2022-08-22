## Start apache, mysql and composer from docker

```
docker-compose up
```

## Or manuelly start laravel developer server

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

## Perform feature tests

```
php artisan test --testsuite=Feature
```

## Run code sniffer

```
docker run --rm -v $(pwd):/data cytopia/phpcs --standard=PSR12 app database routes resources tests

```
