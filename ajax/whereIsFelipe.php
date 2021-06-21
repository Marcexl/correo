<?php
/*
 * mixed by marcexl
 * version 08012021
 * - servicio para traer todos los datos de la persona
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");
include_once("../config/authenticate.php");

$data = new \stdClass();

/* genero un token */
if(isset($_GET['email']))
{
  $email  = $_GET['email'];
  $token  = $bearer_token;
  $random = rand(1, 20);
  $sql = "SELECT Stage, Avatar 
          FROM `whereis` 
          WHERE idStage = $random";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
    $data->success = true;
  	$data->stage   = $row['Stage'];
    if($random > 17)
    {
      $data->avatar  = $row['Avatar'].'.gif';
    }
    else
    {
      $data->avatar  = $row['Avatar'].'.jpg';
    }
  }
  
  $data = json_encode($data);
  echo $data;
  exit();
}
$conn->close();

?>
