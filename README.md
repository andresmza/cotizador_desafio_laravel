<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## DESAFÍO LARAVEL

## DEMO

 - Sistema en producción en un contenedor:

 Acceso: <a href="https://cotizador.ddns.net">Cotizador</a>

## Instalación en entorno local

##  REQUISITOS PREVIOS
 
 - <a href="https://www.mysql.com/">MySQL</a>
 - <a href="https://www.php.net/downloads/">PHP 8.1</a>
 - <a href="https://getcomposer.org/">Composer</a>
 - <a href="https://www.apache.org/">APACHE</a>

##  Pasos a seguir:

 - Clonar el repositorio, preferentemente en  ```/var/www/```:
	
	``` sh
	git clone https://github.com/andresmza/cotizador_desafio_laravel.git
	```

- Una vez dentro del directorio del proyecto ejecutar los siguientes comandos:

    ``` sh
	composer install
	composer update
    cp .env.example .env
    php artisan key:generate
	```

- Ejecutar los siguientes comandos:

    ``` sh
	npm install -g npm@8.19.2
    npm run dev
	```
