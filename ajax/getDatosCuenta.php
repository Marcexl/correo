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

  $sql = "SELECT * 
          FROM `people` 
          WHERE Email = '$email' 
          AND Active = 1";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
   $data->success = true;
   $data->lname   = $row['LastName'];
   $data->fname   = $row['FirstName'];
   $data->username = $row['Username'];
   $data->gender  = $row['Gender'];
   $data->pass    = $row['Pass'];
   $data->edad    = $row['Edad'];
   $data->avatar  = $row['Avatar'].".png";
  }
  
 
  $data = json_encode($data);
  echo $data;
  exit();
}
$conn->close();

?>
