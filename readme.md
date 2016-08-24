# Wall Of Fame - Laravel Backend API

[![StyleCI](https://styleci.io/repos/60344081/shield?style=flat)](https://styleci.io/repos/60344081)
[![Build Status](https://travis-ci.org/DerrickJames/wall-of-fame-api.svg)](https://travis-ci.org/DerrickJames/wall-of-fame-api)

This is the backend implementation of the Wall Of Fame project using Laravel 5.2. It is meant to be a playground to test out different ideas and approaches gathered over time as a software developer from various books, articles, tutorials and experiences on large scale system architectures, API development, design patterns, best practices and generally the way I think about elegant code.

## Requirements
    
  * Redis
  * Composer
  * Node & NPM
  * Apache/Nginx
  * PHP minimum version of 5.5
  * PostgreSQL - The default database is PostgreSQL but you can switch to MySQL if that makes more sense to you.

## Installation

Make sure you have Apache/Nginx, PostgreSQL, PHP and a redis-server running.
If you don't have a redis-server running, be sure to check out the redis [quickstart
guide](http://redis.io/topics/quickstart) on how to setup and bootup a
redis-server.

Create a database named `fame` or whichever name you like. Setup the database configuration in your .env file.

Run the following commands from your terminal.

    $ git clone https://github.com/DerrickJames/wall-of-fame-api.git
    $ composer install
    $ php artisan jwt:generate
    $ php artisan migrate --seed

Make sure all tests pass.

    $ phpunit
    $ php artisan serve

Check inside the database seeds for default users.

## API Documentation

To generate the API documentation, run the following commands from your terminal.

Install [apidocjs](http://apidocjs.com/) package if you don't already have it installed on your system.

    $ npm i -g apidoc

Make sure you're in the root directory.

    $ cd wall-of-fame-api
    $ sh apidoc.sh

That should generate and launch the documentation on your browser.
