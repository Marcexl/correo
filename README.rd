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
GIT repo: https://github.com/Marcexl/felipe.git
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
1) Clona el repositorio en un directorio local a:
c:/xampp/htdocs/apps/felipe

2) Para que la app funcione necesitamos instalar la BD en un mysql
CREATE DATABASE IF NO EXISTS felipe; 

3) Importa el archivo "whereis.sql", en la base de datos que creaste, el mismo se encuentra en la carpeta mysql. O crea las tablas corriendo los scripts que se encuentran en él.

4) De ser necesario modificá los datos del archivo config.php por ejemplo el usuario y pass que accede a la BD. Sino deja los de root
client_id y client_secret las tenes en tu consola de google https://console.cloud.google.com/
las actuales solo funcionan para la uri http://localhost/apps/felipe 

5) Listo! ya podes correr la aplicacion ingresando a la url que creaste.

Actualmente se puede acceder a esta version en:
https://marcexlweb.com/apps/felipe/

Listado de servicios:
https://docs.google.com/spreadsheets/d/15ytYz3ttMUK7Dr0F9YoiCLyVvN594ltdxwu-4SWMd3M/edit?usp=sharing

*************
* Contenido *
*************
La aplicacion es una primera version prototipo de un juego simple.
La idea es no perder de vista a Felipe porque se suele escapar.
Una ves registrado cada ves que ingreses al menu de "donde", va a mostrar de forma aleatoria diferentes lugares de a donde esta Felipe.
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
Falta implementar Notificaciones push
Falta implementar los botones para sumar o restar puntaje y las tablas
Se deberia poder migrar a cordova o react para poder compilar una app

*******************
* Agradecimientos *
*******************
A mi gato Felipe, que siempre se escapo durante toda la cuarentena, molestando a los vecinos
y que me dio la idea de poder hacer el juego.
A mi pareja Maju que me cebo con la idea.
