
*********				*********************		  ********************       
*********				**********	**********	     **********  *********
*************		**************   **********		**********   *********
**********************************    **********   **********    *********
**********************************     ********************      *********
********   ***********  **********     ********************      *********
********    ********    **********     **********  *********     *********
********      ****      **********    **********    **********   *********
********                **********   **********      **********  ********************
********                **********  **********        ********** ********************
********                *********************          ******************************

************
* version  *
************
VERSION 1.1.3
PUESTA en produccion: 21/06/2021
LASTUPDATE: 21/06/2021
Ciudad Autonoma de Buenos Aires
Author: Marcelo A. Gallardo
email: mxlgallardo@gmail.com
GIT repo: https://github.com/Marcexl/correo.git
Actualmente echo en PHP, HTML, CSS, JS con Jquery

**************************
* Librerias / frameworks *
**************************
Bootstrap v5.0
Jquery v3.5.1
Fontawesome v5.15.1

**********************************
* Instrucciones de configuración *
**********************************
1) Clona el repositorio en un directorio local por ej:
c:/xampp/htdocs/apps/felipe

2) Para que la app funcione necesitamos instalar la BD en un mysql
CREATE DATABASE IF NO EXISTS felipe; 
o el nombre que quieras

3) Crea un usuario y contraseña para la BD o deja los GRANT de root

4) Modificá los datos de usuario y contraseña del archivo config.php

5) Modifica la variable $http del archivo config.php a donde hayas clonado el repo
por ej: http://localhost/apps/felipe

6) Listo! ya podes correr la aplicacion ingresando a la url que creaste.

Actualmente se entrega con las credenciales de ejemplo localhost del xampp
Luego es solo correr la app ya sea en un ambiente local o en una url publica.
Actualmente se puede acceder a esta version en

https://marcexlweb.com/apps/felipe 

*************
* Contenido *
*************
La aplicacion es una primera version prototipo de juego simple.
La idea es no perder de vista a Felipe porque se suele escapar.
Una ves registrado cada ves que ingreses al menu de "donde" 
Va a mostrar de forma aleatoria diferentes lugares de a Donde esta Felipe.
Si tiene que ir al veterinario vas a tener que pulsar "llevar a veterinario"
Si esta durmiendo puede despertarlo o dejarlo dormir.
Si tiene hambre puedes darle de comer o dejarlo hambriento porque todavia no es la hora.
Todas estas acciones van sumando puntos, si en un considerable tiempo no le prestas atención entonces de seguro el gato se escapará y con eso pierdes puntos.


**********************************
* Modulos que faltan actualmente *
**********************************
Falta poder crear un abm para poder subir fotos y opciones de donde podria estar el gato
Falta poder chequear y modificar el level de juego 
Falta poder chequear y mostrar el puntaje acumulado
Notificaciones push
Se deberia poder migrar a cordova o react para poder compilar una app

*******************
* Agradecimientos *
*******************
A mi gato Felipe, que siempre se escapo durante toda la cuarentena molestando a los vecinos
y que me dio la idea de poder hacerlo.
A Correo Argentino que gracias al challenge pude empezar a armar el prototipo
