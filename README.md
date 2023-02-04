<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Inicio del proyecto

### Requerimientos del sistema
Version php `8.0.11`, 
php Base de datos `MySql`. 
composer [Link descarga](https://getcomposer.org/download/) 

### Inicio del proyecto 
1. Desde el proyecto existe un archivo llamado `.env.example` editar con el nombre `.env`, una ves realizado editar las variables de conexion a la base de datos.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
2. Añadir en el .env `APP_KEY=`
```
 base64:ohTW80TpWZiEbSCZDNA9EVh+JFkgD26FN1qk+R1JGMQ=
```

3. crear base de datos ejemplo: `prueba-tecnica-aveonline`

4. Realizar desde consola en el proyecto los siguientes pasos preparar proyecto:
```
a. composer update
b. npm install
```

5. Realizar desde consola en el proyecto los siguientes pasos iniciar base de datos:
```
a. php artisan migrate
b. php artisan db:seed
```
El caso que no se ejecute la migración desde artisan se cuenta con un schema ela ruta  `database\prueba-tecnica-aveonline.sql`

6. Realizar desde consola en el proyecto los siguientes pasos iniciar proyecto:
```
a. en una consola ejecutar ->  php artisan serve
b. en otra consola ejecutar ->  npm run dev
```

7. Los datos de acceso a la aplicación:
```
 login = admin@example.com
 password =  12345
```


## Listo....


