<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para registrar personas
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");

$data = new \stdClass();
$idPeople = '';
if( (isset($_POST['email'])) and (isset($_POST['nombre'])) and (isset($_POST['lname'])) and (isset($_POST['fname'])) and (isset($_POST['avatar'])))
{

	$username  = $_POST['nombre'];
	$useremail = $_POST['email'];
	$userpass  = '';
	$lastname  = $_POST['lname'];
	$firstname = $_POST['fname'];
	$gender    = 0;
	$active    = 1;

  $e = checkIfExist($useremail);

  if($e == 1)
  {
    $data->success = true;  
    $data->code    = 1;  
    $data->msj     = "Este usuario ya lo registraste, pero debes activar tu cuenta.";
    $data = json_encode($data); 
    echo $data;
    exit();       
  } 

  if($e == 2)
  {
    $idPeople = getIdPeople($useremail);
    $token    = getToken($idPeople);
    
    $data->success = true;
    $data->code    = 2;  
    $data->token   = $token;
    $data->email   = $useremail;  
    $data = json_encode($data); 
    echo $data;
    exit();       
  }

	$sql = "INSERT INTO `people`(`LastName`, `FirstName`, `Username`, `Gender`, `Email`, `Pass`,`Active`) VALUES ('$lastname','$firstname', '$username', $gender, '$useremail', '$userpass',$active)";
	if ($conn->query($sql) === TRUE) 
	{
    /* obtengo el idpeople*/
    $idPeople = getIdPeople($useremail);
    
    /* genero el token */
    $token = generaToken(30);
    
    $sql1 = "INSERT INTO `token` (`idPeople`, `Token`, `Active`) VALUES ($idPeople,'$token',1)";
    if ($conn->query($sql1) === TRUE) 
    {

      /* inserto el registro y mando mail */
      $sql2 = "INSERT INTO `match` (`Player1`,`Player2`, `Active`) VALUES ($idPeople,'',0)";
      if ($conn->query($sql2) === TRUE) 
      {
        /* 
         * 4) Inserto en la tabla Score
         */
        $sql3 = "INSERT INTO `score` (`idPlayer`, `Score`) VALUES ($idPeople,0)";
        if ($conn->query($sql3) === TRUE) 
        {
          /* envio el mail activate */   
          enviarMail($useremail,$username,$token);
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">
                  No se ha podido setear el score!
                </div>';
          echo $sql3;
          exit();
        }
        
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">
                  No se ha podido iniciar el match!
                </div>';
          echo $sql2;
          exit();
        }
  	}
    else 
    {
      $data->success = false;  
      $data->msj     = "No se ha podido ingresar el token.";
      $data = json_encode($data); 
      echo $data;
      exit();       
    }
	} 
	else 
	{
    $data->success = false;  
    $data->msj     = "No se ha podido ingresar el usuario.";
    $data = json_encode($data); 
    echo $data;
    exit();       
	}
}

$conn->close();

function enviarMail($email,$username,$token)
{
  GLOBAL $http;

  $data = new \stdClass();

  $para      = $email;
  $titulo    = 'Gracias por registrarte en 2Gether';
  
  // To send HTML mail, the Content-type header must be set
  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=iso-8859-1';
  
  // Additional headers
  $headers[] = 'From:Register <no-reply@2gether.ar>';

  $msj = '
    <html>
    <head>
      <title>'.$titulo.'</title>
      <style>
        .flyer{
          display:block;
          margin:0 auto;
          width: 90%;
          max-width: 450px;
        }
      </style>
    </head>
    <body>
    <p>¡Hola <b>'.$username.'<b>!</p>
    <p>Gracias por registrarte. Si ingresaste con tu cuenta de Google o Facebook es todo mucho mas facil!</p>
    <p>Ya podes empezar a jugar!</p>
    <p><a href="'.$http.'">Comenzar</a></p>
    </body>
    </html>
    ';
  $mensaje   = $msj;
    
  if (mail($para, $titulo, $mensaje, implode("\r\n", $headers)))
  {

    $data->success = true; 
    $data->token   = $token;
    $data->email   = $email;
    $data = json_encode($data);    
  } 
  else
  {
  	$data->success = false;  
    $data->msj     = "No se ha podido enviar el email.";
    $data = json_encode($data); 
    
  }

  echo $data;
  exit();    
}

?>

