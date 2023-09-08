<h1> Project setup</h1>

<h4> Create your own .eng file </h4>

```shell
cp .env.example .env
```

<h4> Install PHP dependencies </h4>

```shell
composer install
```

<h4> Run building command </h4>

``` shell
sudo ./vendor/bin/sail build --no-cache
```

<h4> Up containers</h4>

``` shell
sudo ./vendor/bin/sail up
```

<h4> Add roles for users </h4>

```shell
sudo docker exec -it wishlist_project-laravel-1 php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

<h4> Run migrations for database </h4>

``` shell
sudo docker exec -it wishlist_project-laravel-1 php artisan migrate
```

<h4> Run seeders for database </h4>

``` shell
sudo docker exec -it wishlist_project-laravel-1 php artisan db:seed
```




