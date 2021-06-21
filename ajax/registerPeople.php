<?php
/*
 * mixed by marcexl
 * version 18062021
 * - servicio para registrar personas
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");

$data = new \stdClass();

if( (isset($_POST['username'])) and (isset($_POST['useremail'])) and (isset($_POST['userpass'])) )
{

	$username  = $_POST['username'];
	$useremail = $_POST['useremail'];
	$userpass  = $_POST['userpass'];
	$lastname  = '';
	$firstname = '';
	$gender    = 0;//por defecto hasta que se seleccione
  $active    = 0;//por defecto hasta que active su cuenta con el mail

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
    $data->success = true;
    $data->code    = 2;    
    $data->msj     = "Este usuario ya lo registraste. Si queres podes logearte.";
    $data = json_encode($data); 
    echo $data;
    exit();       
  }

  $u = checkIfUserExist($username);

  if($u == 1)
  {
    $data->success = false;  
    $data->code    = 4;  
    $data->msj     = "El nombre de usuario ya existe.";
    $data = json_encode($data); 
    echo $data;
    exit();       
  }
  
	$sql = "INSERT INTO `people`(`LastName`, `FirstName`, `Username`, `Gender`, `Email`, `Pass`,`Active`) VALUES ('$lastname','$firstname', '$username', $gender, '$useremail', '$userpass',$active)";
	if ($conn->query($sql) === TRUE) 
	{
    /* inserto el registro y mando mail */
	  //enviarMail($useremail,$username);
    $token = generaToken(30);
	  $data->success = true; 
    $data->token   = $token;
    $data->email   = $useremail;
    $data = json_encode($data); 
    echo $data;
    exit();     
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

function enviarMail($email,$username)
{
  GLOBAL $http;

  $data = new \stdClass();
	$token = generaToken(30);

  $para      = $email;
  $titulo    = 'Gracias por registrarte en Felipe';
  
  // To send HTML mail, the Content-type header must be set
  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=iso-8859-1';
  
  // Additional headers
  $headers[] = 'From:Register <no-reply@felipe.com.ar>';

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
    <p>Para activar tu cuenta por favor hace clic en el siguiente link</p>
    <p><a href="'.$http.'/ajax/activation.php?token='.$token.'&email='.$email.'">Activar cuenta</a></p>
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

