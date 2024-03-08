# Blog Systen
This is a simple blog system made for my own website and for showcasing code structure. Just follow the setup 
instructions below to try it out. It's just a simple showcase of coding practices and is used on my personal blog.

![Selection_362.png](public%2Fmd_files%2FSelection_362.png)

![Selection_363.png](public%2Fmd_files%2FSelection_363.png)

## Overview
 Project is made with 
- Nginx,
- Laravel, 
- Postgres, 
- Tailwind, 
- Docker.

Project was bootstrapped with Laravel Jetstream for faster time to go live.

### Structure and practices
Code style is PSR standard. Common Laravel elements used are:
 - Resource Controllers
 - Models
 - Requests
 - Resources
## How to setup
Setup is simple. 

First we need to install Laravel framework and PHP dependencies. Running the next command 
will install packages and create all needed docker containers and run all migrations  

`docker compose up -d`

Add one record to your hosts file:

`127.0.0.1     blog.localhost`

Visit http://blog.localhost page on your host system and enjoy viewing the blog. To populate 
with a dummy category, run the next seeder:

`docker compose exec app php artisan db:seed BlogSeeder`



### Code style checks
Run command to do Code Style checks.
`docker compose exec app ./vendor/bin/pint`
### Static Analysis
Run command to do static analysis of the code:
`docker compose exec app ./vendor/bin/phpstan analyse`
### Unit and Feature Testing
Run command to run all unit tests:
`docker compose exec app php artisan test`
