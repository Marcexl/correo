<?php
/*
 * mixed by marcexl
 * version 2106021
 * - servicio para agregar lugar
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
  $token  = $bearer_token;

  $email  = $_POST['email'];
  $lugar  = $_POST['lugar'];

  $idPeople = getIdPeople($email);//busco el idPeople

  $sql = "INSERT INTO `lugares` (idPeople,Lugar,Active) VALUES ($idPeople,'$lugar',1)";
  if ($conn->query($sql) === TRUE) 
  {
    $data->success = true;
    $data = json_encode($data);
    echo $data;
    exit();
  }
  else
  {
    $data->success = false;
    $data->msj = "No se ha podido agregar el lugar.";
    $data = json_encode($data);
    echo $data;
    exit(); 
  }
  
}

$conn->close();

?>
