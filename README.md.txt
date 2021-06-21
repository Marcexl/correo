
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
VERSION 1.0.9
PUESTA en produccion: 16/09/2020
LASTUPDATE: 15/06/2021
Ciudad Autonoma de Buenos Aires
Author: Marcelo A. Gallardo
email: mxlgallardo@gmail.com

**********************************
* Instrucciones de configuraci�n *
**********************************
Para que el sistema funcione dependiendo del servidor
hay que modificar el usuario y contrase�a del archivo config
para que coincida con el ambiente con la BD.
Actualmente se entrega con las credenciales de DESARROLLO
Se necesita un directorio para poder alojar los archivos subidos por la persona.

Clases usadas: 
del famoso LQUIROGA 
require_once("/web/html/classesUSAL/class_TokenPreingreso.php
require_once("/web/html/classesUSAL/class_FormsCircuito.php");
require_once("/web/html/classesUSAL/class_NroTransaccionPreinscripcion.php");

del pirata IBERLOT
include_once("/web/html/classes/class_db.php");
include_once("/web/html/classes/class_files.php");

Librerias:
php-image-rezise
fpdf
phpmailer
jquery-3.5.1

CSS
original by marcexl

listado de servicios en:
https://docs.google.com/spreadsheets/d/1jQBbXrbvJsczx9IC9Swe9v-2JJ3zxqbeRGSFipygYdg/edit#gid=0

esquema de funcionamiento en segun el caso:
https://docs.google.com/document/d/1FrOHoo3iBPAbfprbe3IETQYQrWDvnSE57np91wvUAJg/edit?usp=sharing


*************
* Contenido *
*************
El sistema de preinscripcion de la USAL permite a las personas nuevas, alumnos o exalumnos, poder registrarse para preinscribirse a alguna carrera de la Universidad.
El sistema consiste en un login con validadcion por mail y un recaptcha de google v2
Luego son 4 pasos a seguir para subir la informacion de la persona.
Tambien el sistema te permite solo pedir informacion con un formulario simple y no anotarse directamente.
Actualmente echo en PHP, HTML, CSS, JS con Jquery

********************************
* Algunas de las NO soluciones *
********************************
No posee validacion oauth que seria ideal hoy con google o facebook.
No permite el ingreso de documentacion como PNG u otros formatos.
Los servicios que se consultan no estan validando el token a pesar de tenerlo para pasarlo. (error mio)
Las imagenes subidas no tienen control de calidad. 
Este sistema no posee aun plataforma de pago.
No levanta las escuelas del ministerio de educacion usa una tabla interna
No posee perspectiva de genero solo figuran como generro masculino y femenino muy del a�o 1950

**********************************
* Algunas de las mejoras en 2021 *
**********************************
se eliminaron campos en el formulario como datos del padre
se elimino el cuil como dato obligatorio
el sistema ahora envia una copia de la documentacion a la unidad academica y ese dato esta en una base
el sistema ahora te permite ingresar cuantas veces quieras teniendo el mail con el token vigente ya que no expira

*******************
* Recomendaciones *
*******************
1) A futuro seria ideal no cargar tantos datos para el ingreso a una carrera. 
2) hacer alguna encuesta con los alumnos para tener opiniones acerca de si esta lindo o es un bodrio este sistema
3) Las tablas son bastante complejas hay datos que se cargan en el paso 1 como null pero luego se pisan en el paso final con datos empiricos y son muchas tablas para una presinscripcion, demasiadas hay que achicar.
4) Seria ideal ya migrar a algun framwork como react, angular o vue
5) Nunca hice backup por favor recordarmelo.
6) El genero ya no es mas masculino y femenino google y otras plataformas que trabajan muy bien 
ya conciben el genero como "otro" o "ninguno", algo que recomende agregar pero no me dieron mucha bola en 2019.

*******************
* Agradecimientos *
*******************
A las heroinas de las bases de datos que estuvieron dedicandole horas 
al ingreso de datos correctamente Mari y Mari.
A los chicos y chicas de atencion a usuario 
que son quienes conocen la din�mica del usuario 
y cuales serian los pasos mas intuitivos a la hora de tomar decisiones. 
Flor, Ana, Fer gracias por la paciencia.
