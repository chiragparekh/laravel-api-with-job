## Laravel API with Job and Events Demo

Application contains **/api/submit** endpoint to create submissions.

## Installation

Follow the steps to install the application:

1. Run following command to install the composer dependency without installtion composer in local machine. 

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer update laravel/sail
```

2. Start docker containers
```shell
vendor/bin/sail up -d
```

3. Migrate database tables using following command: 
```shell
vendor/bin/sail php artisan migrate
```

Now you are ready to use the endpoint.

## Endpoints

#### Create new submission

<details>
 <summary><code>POST</code> <code><b>/api/submit</b></code> <code>(create submission in system)</code></summary>

##### Parameters

> | name    |  type     | data type | description                                                           |
> |---------|-----------|-----------|-----------------------------------------------------------------------|
> | name    |  required | string    | N/A  |
> | email   |  required | string    | Provide valid email address |
> | message |  required | string    | N/A |