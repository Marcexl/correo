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

if(isset($_GET['provincia']))
{
	$select = '<option value="">Seleccioná una provincia</option>';

	$sql = "SELECT idProvincia, Descripcion 
			FROM `provincias` ORDER BY Descripcion ASC";
  	$resultado  = $conn->query($sql); 
  	while ($row = $resultado->fetch_assoc()) 
  	{
    	$select .= '<option class="colorgrey" value="'.$row['idProvincia'].'">'.$row['Descripcion'].'</option>';
 	}

	echo $select;
	exit();
}