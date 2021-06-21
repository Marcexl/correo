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
if(isset($_GET['email']))
{

  $email  = $_GET['email'];
  $token  = $bearer_token;

  $idPeople = getIdPeople($email);//busco el idPeople

  $i = 0;
  $table = '';

  $sql = "SELECT * 
          FROM `lugares` 
          WHERE idPeople = '$idPeople' 
          ORDER BY Lugar ASC";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
    $i++;
    $idLugar = $row['idLugar'];
    $lugar   = $row['Lugar'];
    $table .= '<tr>';
    $table .= '<td>'.$i.'</td>';
    $table .= '<td>'.$lugar.'</td>';
    $table .= '<td><i class="fas fa-edit"></i> <i class="fas fa-trash" onclick="deleteLugar('.$idLugar.')"></i></td>';
    $table .= '</tr>';
   
  }
  
  echo $table;
  exit();
 
}
$conn->close();

?>
