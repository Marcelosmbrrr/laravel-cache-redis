## Build Container

```
docker-compose up -d
```

## Install dependencies

```
docker-compose exec app bash
composer install
exit
```

## Testing

```
Get Users with cache: localhost:8000/cache
Get Users without cache: localhost:8000/no-cache
```

## Monitoring

In the Telescope interface, in the "Requests" section, is possible to check the requests made and the time spent on each one.

Requests to /cache are generally faster than those to /no-cache, also is possible to verify that requests to /cache do not query the database.

```
localhost:8000/telescope
```


