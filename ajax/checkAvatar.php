<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para ver si eligio un avatar
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");
include_once("../config/authenticate.php");

$data = new \stdClass();

/* genero un token */
if(isset($_POST['email']))
{
  $email  = $_POST['email'];
  $token  = $bearer_token;
  $avatar = '';

  $sql = "SELECT Avatar 
          FROM `people` 
          WHERE Email = '$email' 
          AND Active = 1";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
  	$avatar = $row['Avatar'];
  }
  
  if($avatar == 0)
  {
    $data->success = false;
    $data->msj = 'Seleccioná un avatar.';
  } 
  else 
  {
    $data->success = true;
  }
  $data = json_encode($data);
  echo $data;
  exit();
}
$conn->close();

?>
