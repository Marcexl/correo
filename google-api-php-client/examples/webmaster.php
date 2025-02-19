<?php
session_start();
$title = 'Webmaster';
$web = 'active';
require_once ("../src/Google/autoload.php");
/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = '948603352325-q1i0e97gdjo1qfm3qotk7ocqldnukf0t.apps.googleusercontent.com';
 $client_secret = 'BEHu_etb9X3ckrAwdAOpMEEv';
 $redirect_uri = 'http://www.marcexl.com.ar/google-api-php-client/examples/login.php';

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/plus.me");

/************************************************
  We are going to create both YouTube and Drive
  services, and query both.
 ************************************************/
$plusService = new Google_Service_Plus($client);



/************************************************
  Boilerplate auth management - see
  user-example.php for details.
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  Aca comienza la hoja html con el codigo
  primero si no estamos logueados
************************************************/

if (isset($authUrl)) {
  include ("header.php");
  include ("menu.php");#incluimos el menu general
 echo '<section id="servicios"><div class="content"><div class="login">';

  echo '<p align="center"><u>Consideraciones acerca del uso de logueo</u></p>';
  echo '<p>&nbsp;</p>';
  echo '
        <ol>
          <li>Este sistema utiliza la validacion de Oauth 2.0. conectandose de la API de Google.</li>
          <li>Debes tener una cuenta Gmail o registrada en Google para poder loguearte.</li>
          <li>Recuerda que no es posible obtener datos personales al ingresarlos ya que el sistema de acceso es por fuera de nuestros servidores.</li>
          <li>Al aceptar los terminos y condiciones estas aceptando las condiciones de Google</li>
          <li>Marcexl.com.ar te puede ayudar ante cualquier duda o consulta que quieras hacer.</li>
        </ol>
        ';
  echo '<p align="center"> <i>Version 10092015</i></p>';
  echo '<p align="center"> &nbsp;</p>';
  echo '<p align="center"><a class="butForm" href="'. $authUrl .'">Ingresar</a></p>';
  echo '<p>&nbsp;</p></div></div></section>';
} else {
    /************************************************
      Aca ya ingresamos!!!
    ************************************************/

    /********Api login************/
    $me = $plusService->people->get('me');
    include ("header.php");
    include ("out.php");
    
    echo '<section id="contact">
    <div class="content">
      <h3>Recorrido</h3>
        <fieldset>
          <ul class="cursos">
            <li>En 2004 hizo un curso de armado y reparación de pc. </li>
            <li>En 2005 incursiono en las primera paginas web utilizando dreamweaber ,  flash mx y fireworks. </li>
            <li>En 2006 hizo un curso de Adobe Photoshop CS. </li>
            <li>En 2007 realizo un curso de Flash CS y Action Script 2.0. </li>
            <li>En 2008 realizo los primeros sitios en html, css y action script 2.0. </li>
            <li>En 2012 realizo varios trabajos freelance usando photoshop, dreamweaber y flash CS. </li>
            <li>En el año 2013 creación de mas sitios web usando CSM, manejo de HTML5, CSS3, jquery y javascript  comenzando a realizar los primeros sitios responsive.</li>
            <li>En el año 2014 realizo un curso de PHP y MYSQL  en ITmaster con certificación. </li>
          </ul>
          <p></p>
        <p>Actualmente trabaja en el Departamento de sistemas de la USAL en el área de desarrollo y mantenimiento de aplicaciones web, usando PHP, HTML5, CSS3, JQUERY, MYSQL, SQL y PERL. </p>
        <p>En el año 2015 se crea marcexl.com.ar actualmente mantiene 5 sitios web.</p>
        <p align="center"><a href="https://ar.linkedin.com/pub/marce-excel/35/b02/2b" target="_blank"><img src="img/logos/linkedin.png" class="in"></a></p>
        </fieldset>
  </div>
</section>';
  }
?>
<?php
  include("footer.php");#incluimos el footer
?>