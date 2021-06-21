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
  $token     = $bearer_token;
  $email     = $_POST['email'];
  $userlname = $_POST['userlname'];
  $userfname = $_POST['userfname'];
  $useredad  = $_POST['useredad'];
  $gender    = $_POST['gender'];
  $provincia = $_POST['provincia'];
  $localidad = $_POST['localidad'];

  $sql = "UPDATE `people`
          SET LastName = '$userlname',
          FirstName = '$userfname',
          Edad = $useredad,
          Provincia = $provincia,
          Localidad = $localidad,
          Gender = '$gender'
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
    $data->msj = 'Ups no hemos podido actualizar los datos. Intentálo mas tarde.';
    $data = json_encode($data);
  }
  echo $data;
  exit();

}

$conn->close();

?>