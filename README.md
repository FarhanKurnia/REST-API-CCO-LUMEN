# REST API Customer care apps with Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

<p>This project was created as a thesis research topic for graduation requirements. Created using the Lumen framework by implementing the SDLC waterfall method, REST API architecture, PostgreSQL for database, JWT Token for authentication and Pusher as a third party web socket. The things that have been done during the application development period, including: gathering requirements, designing UML and tables, implementing the design (coding), integrating third-party web sockets and the result is an endpoint that is consumed by the front-end.</p>

Feature:
1. User
    - Register User
    - Login User
    - Logout User
    - Show Profile User
    - Edit Profile User

2. BTS
    - Show All BTS
    - Show One BTS
    - Create BTS (Admin only)
    - Update BTS (Admin only)
    - Delete BTS (Admin only)

3. Keluhan
    - Show All Keluhan
    - Show One Keluhan
    - Create Keluhan
    - Update keluhan
    - Delete Keluhan
    - Close Keluhan
    - Reopen Keluhan
    - Search History Keluhan

4. Balasan
    - Show All Balasan
    - Show One Balasan
    - Create Balasan

5. POP
    - Show All POP (Admin only)
    - Show One POP (Admin only)
    - Create POP (Admin only)
    - Update POP (Admin only)
    - Delete POP (Admin only)

6. Role
    - Show All Role (Admin only)
    - Show One Role (Admin only)
    - Create Role (Admin only)
    - Update Role (Admin only)
    - Delete Role (Admin only)

7. Sumber Keluhan
    - Show All Sumber Keluhan (Admin only)
    - Show One Sumber Keluhan (Admin only)
    - Create Sumber Keluhan (Admin only)
    - Update Sumber Keluhan (Admin only)
    - Delete Sumber Keluhan (Admin only)

8. User
    - Show All User (Admin only)
    - Show One User (Admin only)
    - Update User (Admin only)
    - Delete User (Admin only)

9. RFO Gangguan
    - Show All RFO Gangguan
    - Show One RFO Gangguan 
    - Update RFO Gangguan 
    - Search RFO Gangguan 
    
9. RFO Keluhan
    - Show All RFO Keluhan 
    - Show One RFO Keluhan 
    - Update RFO Keluhan 


![ERD](Images/erd.png "ERD")


Relation:
- Users with POP (One to Many) 
- Users with Role (One to Many)
- BTS with POP (Many to One)
- BTS with User (Many to One)
- Keluhan with POP (Many to One)
- Keluhan with User (Many to One)
- Keluhan with Balasan (One to Many)
- Balasan with User (Many to One)

Authentication:
- JWT Auth

Middleware:
- Admin
- NOC & Helpdesk


------------------------------------------------------------------------
## Documentation API
API documentation can be accessed via https://documenter.getpostman.com/view/20083017/2s84DoRi5k

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

4. Create JWT Secret </br>
    ```
    php artisan jwt:secret
    ```

5. Copy and Set up environment</br>
    ```
    cp .env.example .env
    ```

6. Customize environment (.env) files with DB name that has been created.</br>

7. Install your extension of PHP (Ubuntu) depend on what the db that you use (optional) </br>
    ```
    sudo apt-get install php7.4-pgsql
    ```

8. Migrate and seed table</br>
    ```
    php artisan migrate --seed
    ```

9. Run local server</br>
    ```
    php -S localhost:8000 -t public
    ```
