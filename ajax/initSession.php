<?php
/*
 * mixed by marcexl
 * version 21122020
 * - servicio para iniciar Sesion
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");

$data = new \stdClass();

if( (isset($_POST['useremail'])) and (isset($_POST['userpass'])) )
{
 
  $useremail  = $_POST['useremail'];
  $userpass   = $_POST['userpass'];


  /* 
   * 1) primero busco el nombre de usuario
   */
  $useremail2 = checkUser($useremail);

  /*
   * 2) si el usuario pasa busco el idPeople
   */
  $idPeople   = checkPass($userpass,$useremail2);
    
  /*
   * 3) genero el token del usuario activo = 1
   */
  $sql = "SELECT Token FROM `token` 
          WHERE idPeople = $idPeople 
          AND Active = 1";
  $resultado = $conn->query($sql); 
  if ($resultado && $resultado->num_rows > 0) 
  {
    while($row = $resultado->fetch_assoc()) 
    {
      $token          = $row['Token'];
      $data->success  = true;
      $data->token    = $token;
      $data->email    = $useremail2;
      $data = json_encode($data);
      echo $data;
      exit(); 
    }
  }
  else
  {
    $data->success = false;
    $data->msj = utf8_encode("Ups no activaste la cuenta aun.");
    $data = json_encode($data);
    echo $data;
    exit();
  }
}
?>

