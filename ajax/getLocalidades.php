<?php
/*
 * mixed by marcexl
 * version 20062021
 * - servicio para elegir avatar
 * 
 */
include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");

if((isset($_GET['provincia'])) AND (isset($_GET['localidad'])) )
{
	$select = '';

	$idProvincia = $_GET['provincia'];
  
  $select = '<option>Seleccioná una localidad</option>';

	$sql = "SELECT idLocalidad, Descripcion FROM `localidades` 
			WHERE idProvincia = $idProvincia 
			ORDER BY Descripcion ASC";
  $resultado  = $conn->query($sql); 
  while ($row = $resultado->fetch_assoc()) 
  {
    $select .= '<option class="colorgrey" value="'.$row['idLocalidad'].'">'.$row['Descripcion'].'</option>';
 	}

 echo $select;
 exit();
}
?>
