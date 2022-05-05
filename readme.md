# Admin-Steades

## Installation

#### Dependencies:

* Composer
* PHP >= 7.2

- Clone the repository and run `composer install` once installed.

- Create database with the name `decave` and collation `utf8_general_ci`

- Create the .env file, you can see the .env.example file now add your db credential in it.

```bash
  DB_DATABASE= ?
  DB_USERNAME= ?
  DB_PASSWORD= ?
 ```

- Set the application key.

 ```bash
 $ php artisan key:generate
 ```

 - Generate autoload files classes.

 ```bash
 $ composer dump-autoload
 ```

- Run artisan migrate and seeder.

 ```bash
 $ php artisan migrate:refresh --seed
 ```

- Run application.

```bash
 $ php artisan serve
 ```
