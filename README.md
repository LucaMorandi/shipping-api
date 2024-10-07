# Shipping API

## Design decisions

- Laravel Sanctum has been used for issuing api tokens.
- Tokens are scoped and configured to expire after one hour.
- The endpoints are versioned and rate limited.
- Shipping options are cached through a materialized view in Postgres.
- This view is refreshed hourly to prevent stale data.
- The view refresh is configured to run concurrently in order to prevent deadlocks.

## Installation instructions

1. Install the application dependencies:

```shell
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php81-composer:latest \
  composer install --ignore-platform-reqs
```

2. Copy `.env.example` to `.env`
3. Run `./vendor/bin/sail up -d` to boot the containers
4. Run the migrations: `./vendor/bin/sail artisan migrate:fresh --seed`
5. Tests can be run as follows: `./vendor/bin/sail test`
6. Finally, use `./vendor/bin/sail down` to shut the containers down.

## Api usage

1. First request an api token by posting your credentials to `/api/v1/sanctum/token`
    - See `ApiTokenCreateRequest` for more details
2. Shipping services can be fetched with a GET request to `/api/v1/shipping/services`
    - Authorize with the api token from step 1 as bearer token
    - See `ShippingServicesIndexRequest` for details

That's all. Have a nice day!
