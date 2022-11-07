<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1 align="center">IT Supporter</h1>

## Prerequisites

`install composer`

**link: https://getcomposer.org**

`install git`

**link: https://git-scm.com/downloads**

## Basic installation steps

1. Clone project:

    ```shell
    git clone https://github.com/online-learning-management/server.git
    ```

1. Navigate to the project folder and run: `composer install`

1. create `.env` file and copy `.env.example` into `.env` file

1. Change the code in `.env` file to your own settings (make sure, `YOUR_DB_NAME` already created)

    ```.env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=YOUR_DB_NAME
    DB_USERNAME=root
    DB_PASSWORD=
    ```

1. Run `php artisan key:generate` to generate the application key

1. Run `php artisan serve` which will start the server at http://localhost:8000

### Create tables and fake data

1. Run `php artisan migrate` to generate the database tables

1. Run `php artisan db:seed` to generate the fake data

### Artisan command

| php artisan serve                                                                                                                                       | run server                               |
| ------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------- |
| php artisan make:model ModelName -m (migration)                                                                                                         | generate Models, migrations code         |
| php artisan migrate                                                                                                                                     | create all tables from migrations folder |
| php artisan make:controller ModelNameController --model=ModelName --requests (create requests file) --api (Controller for api unlike web (- -resource)) | generate Controller and Request          |
| php artisan route:list --except-vendor (except default routes) -v (view middleware)                                                                     | show all the routes                      |
| composer create-project laravel/laravel example-app                                                                                                     | create project via composer              |
| php artisan make:resource User --collection (or php artisan make:resource UserCollection)                                                               | create Resources                         |
| php artisan make:seeder UserSeeder                                                                                                                      | create Seeder to generate fake data      |
| php artisan db:seed                                                                                                                                     | run generate data                        |
| php artisan migrate:refresh --seed                                                                                                                      | refresh table and data                   |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
