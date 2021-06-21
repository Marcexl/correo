<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para elegir avatar
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");
include_once("../config/authenticate.php");

$data     = new \stdClass();
$idPeople = '';
/* genero un token */
if(isset($_POST['email']))
{
  $token    = $bearer_token;
  $email    = $_POST['email'];
  $gender   = $_POST['gender'];

  $sql = "UPDATE `people`
          SET Gender = $gender
          WHERE Email = '$email' 
          AND Active = 1";
  $resultado = $conn->query($sql); 

  if ($conn->query($sql) === TRUE) 
  {
  
    $data->success = true;
    $data = json_encode($data);  
  } 
  else 
  {
    $data->success = false;
    $data->msj = 'Ups no hemos podido actualizar el género. Intentálo mas tarde.';
    $data = json_encode($data);
  }
  echo $data;
  exit();

}

$conn->close();

?>