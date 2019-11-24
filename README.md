# Formset
 
[![Packagist](https://img.shields.io/packagist/v/khyrie/formset.svg?style=plastic)](https://packagist.org/packages/khyrie/formset)
[![Packagist](https://img.shields.io/packagist/dt/khyrie/formset?style=plastic)](https://packagist.org/packages/khyrie/formset)
[![Packagist](https://img.shields.io/packagist/l/khyrie/formset.svg?style=plastic)](https://packagist.org/packages/khyrie/formset)
[![styleci](https://styleci.io/repos/222476788/shield?style=plastic)](https://styleci.io/repos/222476788)
[![Build Status](https://img.shields.io/travis/uekichinos/formset?style=plastic)](https://travis-ci.org/uekichinos/formset)

This package help you to:

1. create table
2. create simple field and data type
3. create migration file

Please take note this package is still under active development. 
Use at your own risk!!! :)


## Requirements

```bash
Laravel >= 6.0
PHP >= 7.2
```


## Installation

Install via composer
```bash
composer require khyrie/formset
```

Run migration command
```bash
php artisan migrate
```
 
Publish configuration file
```bash
php artisan vendor:publish --provider="khyrie\Formset\ServiceProvider" --tag="config"
```

Publish view file
```bash
php artisan vendor:publish --provider="khyrie\Formset\ServiceProvider" --tag="view"
```


## Usage

Navigate to page '/formset'.


## Security

If you discover any security related issues, please email instead of using the issue tracker.


## Credits

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).

And thanks to:

- [laracasts/generators](https://github.com/laracasts/Laravel-5-Generators-Extended)