<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para activacion de la cuenta
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
  $active = '';
  
  $sql = "SELECT Active 
          FROM `people` 
          WHERE Email = '$email'"; 
  $resultado = $conn->query($sql); 

  if ($resultado && $resultado->num_rows > 0) 
  {
    while ($row = $resultado->fetch_assoc()) 
    {
    	$active = $row['Active'];
    }
    if($active == 1)
    {
      $data->success = true;
    } 
    else 
    {
      $data->success = false;
      $data->msj = 'No esta activa la cuenta';
    }
  }
  else
  {
    $data->success = false;
    $data->msj = 'No esta activa la cuenta';
  }
  
  $data = json_encode($data);
  echo $data;
  exit();
}
$conn->close();

?>
