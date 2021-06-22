<?php
session_start();
/*
 * mixed by marcexl
 * version 22062021
 */

include_once ("config/config.php");
include_once ("config/conexion.php");
include_once ("config/funciones.php");
require_once ("google-api-php-client/src/Google/autoload.php");
  
include_once("inc/header.php");

$data = new \stdClass();

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
  $client->setApprovalPrompt("force");

  $client->setScopes(array( 
      "https://www.googleapis.com/auth/plus.login",
      "https://www.googleapis.com/auth/userinfo.email",
      "https://www.googleapis.com/auth/userinfo.profile"
  ));

/************************************************
Se crea el objeto $oauth2Service 
 ************************************************/
$oauth2Service = new Google_Service_Oauth2($client);

/************************************************
Se realiza la solicitud de un acces token 
si es que no esta la sesion iniciada
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
/************************************************
Una vez oauth te devuelve un token lo guardamos 
como variable de session.
 ************************************************/

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  Aca comienza el codigo de la pagina para
  logearse
************************************************/

if (isset($authUrl)) {

?>
 <!-- sections -->
    <section id="login" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-img-left d-none d-md-flex">
               <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body">
              <h1 class="text-center">Login</h1>
              <!--h5 class="card-title text-center">Se suele escapar seguido esperemos que este bien...</h5-->
              <form class="form-signin" id="form-register">
                <p align="center">Aclaraciones al ingresar con tu cuenta de google</p>
                <ul class="oauth">
                  <li>Este sistema utiliza la validación de Oauth conectandose de la API de Google</li>
                  <li>Para ell debes tener una cuenta de google para poder loguearte</li>
                  <li>Tené en cuenta que al aceptar los términos y condiciones, estás aceptando las condiciones de Google</li>
                </ul>
                <a class="btn btn-lg btn-google btn-block text-uppercase mt-3" href="<?php echo $authUrl;?>"><i class="fab fa-google mr-2"></i> Ingresar</a>
                <p class="mt-3 text-center"> <i>Versión 22.06.2021</i></p>
                <hr class="my-4">
                <p align="center">O ingresá con tu cuenta de Felipe.</p>
                <a class="d-block text-center mt-2 small" href="index.php">Volver</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of login -->
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
      $("#login").fadeIn();
    </script>
<?php
   
} 
else 
{

  
  $oauth2Service = new Google_Service_Oauth2($client);
  $userinfo      = $oauth2Service->userinfo;
  $getUser_info  = $userinfo->get();
  
  /*$obj = json_decode($_SESSION['access_token']);
  $_SESSION['refresh_token'] = $obj->{'refresh_token'};*/
    
  /*obtengo el email y me fijo si ya esta registrado */
  $useremail  = $getUser_info['email'];
  $token      = $getUser_info['id'];

  $e = checkIfExist($useremail);
  if($e == 2)
  {
    ?>
    <section id="activation" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center" id="message-activation">
              Estamos logeandote...</h5>
              </div>
          </div>
        </div>
      </div>
    </section><!-- end of activation -->
  <?php
  
    echo '<script src="js/jquery-3.5.1.min.js"></script>
          <script src="js/funciones.js?anio=2021"></script>
          <script src="js/google.js?anio=2021"></script>
          <script>
            $("#loader").fadeIn();
            $("#activation").fadeIn();

            setTimeout(function(){
              initGoogleSession(\''.$token.'\',\''.$useremail.'\');
            },1500);
          </script>'; 
    exit();     
  }
  else
  {

    ?>
    <section id="activation" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center" id="message-activation">
              Estamos registrando tu cuenta e iniciando session...</h5>
              </div>
          </div>
        </div>
      </div>
    </section><!-- end of activation -->
    <?php

    /* si no esta lo insertamos */
    $lastname  = $getUser_info['familyName'];
    $firstname = $getUser_info['givenName'];    

    /*cortamos desde el arroba */
    $cortar    = '@';
    $pos       = strpos($useremail, $cortar);
    $username  = substr($useremail, 0, $pos);
    $userpass  = '';//la constraseña no hace falta porque se logea por google
    
    $gender = 0;//por defecto porque no se puede traer el genero
    $active = 1;//por defecto por entrar por google    
    /*
     * 1) inserto en la tabla people
     */
    $sql = "INSERT INTO `people`(`LastName`, `FirstName`, `Username`, `Gender`, `Email`, `Pass`,`Active`) VALUES ('$lastname','$firstname', '$username', $gender, '$useremail', '$userpass',$active)";

    if ($conn->query($sql) === TRUE) 
    {
      /*
       * 2) busco el idPeople y con eso inserto en token
       */
      $idPeople = getIdPeople($useremail);

      $sql = "INSERT INTO `token` (`idPeople`, `Token`, `Active`) VALUES ($idPeople,'$token',1)";
      if ($conn->query($sql) === TRUE) 
      {
          /*
           * 3) inicio session
           */
  
          echo '<script src="js/jquery-3.5.1.min.js"></script>
                <script src="js/funciones.js?anio=2021"></script>
                <script src="js/google.js?anio=2021"></script>
                <script>
                  $("#loader").fadeIn();
                  $("#activation").fadeIn();
                  setTimeout(function(){
                    initGoogleSession(\''.$token.'\',\''.$useremail.'\');
                  },1500);
                </script>'; 
          exit();     
      }
      else
      {
        $data->success = false; 
        $data->msj     = "No se ha podido insertar el token";
        $data = json_encode($data); 
        echo $data;
        exit();   
      }
    }
    else
    {
      $data->success = false; 
      $data->msj     = "No se ha podido insertar";
      $data = json_encode($data); 
      echo $data;
      exit();     
    }
  }


}
?>

    <!-- JS Library @bymarcexl -->
    <script src="js/session.js?anio=2021"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    </body>
</html>
