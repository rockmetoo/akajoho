Akazoho
========

Analytical tool for Angel's daily information 

## Server Requirements

The Laravel framework has a few system requirements:

* PHP >= 5.4
* MCrypt PHP Extension
* GD PHP Extension
* Composer

## Database Requirements

* MySql >=5.x

## Permissions

You may need to grant the web server write permissions to the app/storage directories

## Install Composer
    
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
    
## Quick Start

Install packages for the first time

    composer install

Run a webserver at default 8000 port. Ctrl+C to stop it

    php artisan serve

## Create Database

    CREATE DATABASE `akazoho` CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    CREATE DATABASE `akazohoUsers` CHARACTER SET utf8 COLLATE utf8_unicode_ci;

## Set User/Password For local `akazoho` and `akazohoUsers` Database
    
    User: homestead
    Password: secret

## Run Migration (only for local and staging - will create tables and sample data)

    composer dump-autoload
    php artisan migrate:refresh --seed
    
## Install Capistrano

    gem install capistrano
    gem install capistrano-composer

## Update Library/Version

    composer update
    composer dump-autoload

## Queue Worker

    php artisan queue:listen

## Apply PSR-2

    php ./vendor/bin/php-cs-fixer fix app/controllers/ --level=psr2

## CSS Minify

    cd PATH/TO/root_dir
    npm install
    grunt cssmin

## Server JST Date Setting

	[AWS]
	cp /usr/share/zoneinfo/Japan /etc/localtime
	
	vi /etc/php.ini
	;date.timezone = → date.timezone = Asia/Tokyo
	
	restart

## Some Good GIT Command To Keep In Mind

    git status
    git add <file name> <file name> <file name>
    git commit -m "<commit message>"
    git push
    
    git pull