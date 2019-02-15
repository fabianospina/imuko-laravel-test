<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Requisitos

PHP ^7.1

## Instalación

Clonar del repositorio así:

$ git clone https://github.com/fabianospina/imuko-laravel-test

Acceder al root de la App

$ cd imuko-laravel-test/

Instalar librerias de la App

$ composer install

Crear archivo .env

$ cp .env.example .env

Editar archivo .env colocando la información para la conexión a Base de Datos

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=TU-BASE-DE-DATOS
DB_USERNAME=TU-USUARIO
DB_PASSWORD=CONTRASEÑA

Lego correr artisan para que cree las tablas de la base de datos

$ php artisan migrate

Por último asegurarse que el servidor web usa como DOCUMENT ROOT la carpeta public de la APP
