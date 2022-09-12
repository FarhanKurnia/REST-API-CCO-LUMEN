# REST API Customer care apps with Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

This REST-API was built using Lumen Framework for Customer care application. </br>
Feature:
- Register User
- Login User
- Logout User

Relation:
- Users with POP (One to Many) 
- Users with Role (On to Many)

Authentication:
- JWT Auth


------------------------------------------------------------------------
## Endpoints
User
</br>`POST:http://localhost:8000/register`
</br>`POST:http://localhost:8000/login`
</br>`GET:http://localhost:8000/logout`

------------------------------------------------------------------------
## Implementations
1. Create Postgre or MySQL database</br>

2. Clone Repository </br>
    ```
    git clone https://github.com/FarhanKurnia/REST-API-CCO-LUMEN.git
    ```

3. Install Composer </br>
    ```
    composer install
    ```

3. Install Lumen Generator (optional) </br>
    ```
    composer require flipbox/lumen-generator
    ```

3. Create JWT Secret </br>
    ```
    php artisan jwt:secret
    ```

4. Copy and Set up environment</br>
    ```
    cp .env.example .env
    ```

5. Customize environment (.env) files with DB name that has been created.</br>

6. Migrate and seed table</br>
    ```
    php artisan migrate --seed
    ```

7. Run local server</br>
    ```
    php -S localhost:8000 -t public
    ```
