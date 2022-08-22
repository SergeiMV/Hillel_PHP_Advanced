## Install dependencies

```
docker run --rm --interactive --tty --volume $(pwd):/app composer install
```
## Or if you hame composer on your local machine

```
composer install
```

## Run a server

```
docker-compose up
```

## Check the site

```
localhost
```

## Run code sniffer

```
docker run --rm -v $(pwd):/data cytopia/phpcs --standard=PSR12 src main public tests
```

## Run a single unit test

```
docker run -it --rm -v $(pwd):/app -w /app php:8.1.4-cli ./vendor/bin/phpunit --do-not-cache-result
```


