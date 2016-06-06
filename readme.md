# Wall Of Fame - Laravel Backend API

[![StyleCI](https://styleci.io/repos/60344081/shield?style=flat)](https://styleci.io/repos/60344081)
[![Build Status](https://travis-ci.org/DerrickJames/wall-of-fame-api.svg)](https://travis-ci.org/DerrickJames/wall-of-fame-api)

This is the backend implementation of the Wall Of Fame project using Laravel 5.2. It is meant to be a playground to test out different ideas and approaches gathered over time as a software developer from various books, articles and tutorials on large scale system architectures, API development, design patterns, best practices and generally the way I think about elegant code.

## Requirements

    * Composer
    * Node & NPM
    * Apache/Nginx
    * PHP minimum version of 5.5
    * PostgreSQL - The default database is PostgreSQL but you can switch to MySQL if that makes more sense to you.

## Installation

Make sure you have Apache/Nginx, PostgreSQL and PHP running.

Create a database named `fame` or whichever name you like. Setup the database configuration in your .env file.

Run the following commands from your terminal.

    $ git clone https://github.com/DerrickJames/wall-of-fame-api.git
    $ composer install
    $ php artisan jwt:generate
    $ php artisan migrate --seed

Make sure all tests pass.

    $ vendor/bin/codecept run
    $ php artisan serve

Check inside the database seeds for default users.

## API Documentation

To generate the API documentation, run the following commands from your terminal.

Install apidocs package if you don't already have it installed on your system.

    $ npm install -g apidocs

Make sure you're on the root directory.

    $ cd wall-of-fame-api
    $ ./apidoc.sh

That should generate and open up the documentation on your browser.
