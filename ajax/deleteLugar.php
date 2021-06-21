<?php
/*
 * mixed by marcexl
 * version 21062021
 * - servicio para traer todos los datos de la persona
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

  $email   = $_POST['email'];
  $idLugar = $_POST['idLugar'];
  $token   = $bearer_token;

  $idPeople = getIdPeople($email);//busco el idPeople

  $sql = "DELETE FROM `lugares` 
          WHERE idPeople = $idPeople 
          AND idLugar = $idLugar";
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
    $data->msj = "No se ha podido eliminar el lugar.";
    $data = json_encode($data);
    echo $data;
    exit(); 
  } 
}
$conn->close();

?>
