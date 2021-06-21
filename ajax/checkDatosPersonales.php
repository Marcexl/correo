<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para saber si eligio el genero
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
  $email    = $_POST['email'];
  $token  = $bearer_token;
  $lname = '';
  $fname = '';
  $edad  = '';

  $sql = "SELECT LastName, FirstName, Edad
          FROM `people` 
          WHERE Email = '$email' 
          AND Active = 1";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
    $lname = $row['LastName'];
    $fname = $row['FirstName'];
  	$edad = $row['Edad'];
  }
  
  if( (empty($lname)) || (empty($fname)) || (empty($edad)) ) 
  {
    $data->success = false;
    $data->msj = 'Actualizá tus datos.';
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
