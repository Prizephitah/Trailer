# Trailer

Trailer is a simple booking system for vehicles. It's purpose is to simplyfy and organize the interaction between 
individuals that want to share one or more vehicles within a well-defined group.

## Application definitions

### Groups

A group contains one or more users of whom at least one is the administrator with editing privileges. It also contains 
an unlimited amount of vehicles witch the users may book to use.

## Building

### Requirements

* PHP >= 5.3
* Composer
* Less

### Composer

Just run `composer install` and everything should fall into place.

### Database migration

Run `php artisan migrate` and the database should set itself up.

### CSS and JavaScript

Run `php artisan basset:build` to build the development variant.

Run `php artisan basset:build -fp` to build the production variant.