## Install dependencies

```
docker run --rm --interactive --tty --volume $(pwd):/app composer install
```

## Or if you hame composer on your local machine

```
composer install
```

## Run database

```
docker-compose up
```

## Make migration

```
php artisan migrate
```

## Seed the database

```
php artisan db:seed
```
