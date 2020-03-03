# MD

## Brief intro

    This API was coded on the Lumen Framework. 
    "Lumen is a micro web framework written in PHP, created by Laravel."
    The API follows a classic Controller/Service micro-service architecture.
    No repository layer was used.
    No "View" of the MVC paradigm was used, as it would be a bit overkill. 


## install instructions

    These instructions are meant to be used on a Linux distro.

    Pre-requirements:
    a) php 7 with mbstring, extdom and pdo_mysql enabled
    b) mysql Server


## Step 1. Install composer

    Composer is a dependency managar for php. Let's install it on your home folder.
    You can delete the composer file when you don't need this anymore.

    $ cd ~
    $ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"    
    $ php composer-setup.php --filename=composer
    $ php -r "unlink('composer-setup.php');"

    Full docs: https://getcomposer.org/download/

## Step 2. Use composer to install project dependencies

    On this project's root folder execute:

    $ ~/composer install 

## Step 3. Create database and set up a new user

    Enter mysql cli with a user with enough privileges to create a database and a user.
    You can use whatever username and password you wish. Just don't forget to set them on the .env file (step 3)

    mysql> CREATE DATABASE md;
    mysql> CREATE USER 'md'@'localhost' IDENTIFIED BY 'mdpassword';
    mysql> GRANT ALL PRIVILEGES ON md.* TO 'md'@'localhost';

## Step 3. Configure application

    edit the .env file and edit, if needed, any or all of the following settings:

    CONFIG_CURRENCIES : allowed currencies separated by ", "
    CONFIG_EXTERNALAPI : external API URL
    CONFIG_CACHE_TTL_IN_MINUTES : cache TTL in minutes

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=md
    DB_USERNAME=md
    DB_PASSWORD=mdpassword    
        
## Step 4. Migrate! This will create the database and cache table

    $ php artisan migrate

## Step 5. Run app on port 3000

    $ php -S 127.0.0.1:3000 -t public

    http://localhost:3000/phptest.html