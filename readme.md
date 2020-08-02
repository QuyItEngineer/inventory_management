## Laravel

 - version: php:7.2-fpm
 - source url: https://github.com/laravel/laravel.git
 
   **Help you build laravel and server with docker so easy. **

## How to build?
### Getting started:

Please install
 - [Docker (recommend)](docker.com)

```
cd {project_dir}
docker-compose build
docker-compose up -d
docker-compose exec app bash
composer install
cp .env.example .env
php artisan key:generate
```
## NOTE docker

 - I noted how to do not use volumes in docker-composer.yml
 
 #####If you do not follow step for me. You can custom:
 ```
 git clone https://github.com/laravel/laravel.git (maybe input name folder)
 cd laravel (or your name folder)
 docker run --rm -v $(pwd):/app composer install
 cp .env.example .env
 ===> edit DB.
 artisan key:generate
```
 
## Install Nodejs and VueJs
php artisan ui vue
npm install
npm install node-sass
npm install popper.js --save
npm install --save-dev sass-loader@7.1.0
npm install popper.js --save
npm audit fix
php artisan ui vue
npm run dev

## More:
Setup laravel source and docker by nginx: 
https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
