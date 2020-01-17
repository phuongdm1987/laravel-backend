## About Project

Project write to learn laravel, design pattern, new technologies

## how to run

- run docker with [laradock.io](http://laradock.io/)
- run `composer install` to install dependence packages
- `cp .env.example .env`
- run `yarn dev` or `npm run dev` to compile asset
- run `php artisan migrate` to create database
- run `php artisan db:seed` to seed database

## deploy on product
- add id_rsa (ssh private key) to ~/.ssh/id_rsa
- change user in php Dockerfile to root
