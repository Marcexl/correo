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
if(isset($_POST['email']))
{
  $token  = $bearer_token;

  $email     = $_POST['email'];
  $username  = $_POST['cuenta-user'];
  $pass      = $_POST['cuenta-pass'];
  $fname     = $_POST['cuenta-fname'];
  $lname     = $_POST['cuenta-lname'];
  $edad      = $_POST['cuenta-edad'];
  $gender    = $_POST['cuenta-gender'];
  $provincia = $_POST['cuenta-prov'];
  $localidad = $_POST['cuenta-loca'];


  $sql = "UPDATE `people` 
          SET Username = '$username',
          FirstName = '$fname',
          LastName = '$lname',
          Pass = '$pass',
          Edad = '$edad',
          Provincia = $provincia,
          Localidad = $localidad,
          Gender = '$gender'
          WHERE Email = '$email'
          AND Active = 1";
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
    $data->msj = "No se ha podido actualizar los datos.";
    $data = json_encode($data);
    echo $data;
    exit(); 
  }
  
 

}
$conn->close();

?>
