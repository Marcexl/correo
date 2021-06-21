<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para chequear si el token fue activado
 * 
 */

include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");
include_once("../config/authenticate.php");

$data     = new \stdClass();
$idPeople = '';

if(isset($_POST['email']))
{
  $token = $bearer_token;
  
  $sql = "SELECT idPeople FROM `token` 
          WHERE token = '$token' 
          AND active = 1";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
  	$idPeople = $row['idPeople'];
  }
  
  if(!empty($idPeople))
  {
    $data->success = true;
    $data = json_encode($data);  
  } 
  else 
  {
    $data->success = false;
    $data->msj = 'No se ha podido insertar el token';
    $data = json_encode($data);
  }

  echo $data;
  exit();

  $conn->close();

}


?>