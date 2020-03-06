## About Project

Project write to learn laravel, design pattern, new technologies

## how to run

- run docker with [laravel ](https://github.com/phuongdm1987/laravel_docker)
- run `composer install` to install dependence packages
- `cp .env.example .env`
- run `yarn dev` or `npm run dev` to compile asset
- run `php artisan migrate` to create database
- run `php artisan db:seed` to seed database
- run `php artisan rinvex:migrate:attributes` to create EAV database
- run `php artisan passport:install` to add access tokendocker
- run `php artisan cache:clear` to clear cache
- run `php artisan storage:link` to make storage link

## how to use
- Authentication with user/pass: phuongdm1987@gmail.com/secret
- go to /horizon to manager queues
- go to /nova to administration panel

## deploy on product
- add id_rsa (ssh private key) to ~/.ssh/id_rsa
- change user in php Dockerfile to root
