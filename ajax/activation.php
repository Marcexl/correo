<?php
/*
 * mixed by marcexl
 * version 18062021
 *
 * servicio para activacion de la cuenta
 * lo mejor es acceder mediante email
 */

include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");

$data = new \stdClass();

/* genero un token */
if(isset($_POST['token']))
{
  $token = $_POST['token'];
  $email = $_POST['email'];
  
  $idPeople = getIdPeople($email);

  /*
   * 1) chequeo que no haya activado ya
   */

    $c = checkToken($token);
    if($c == 0)
    {

	  /*
	   * 2) inserto en la tabla token con activo = 1
	   */
	  $sql = "INSERT INTO `token` (`idPeople`, `Token`, `Active`) VALUES ($idPeople,'$token',1)";
	  if ($conn->query($sql) === TRUE) 
	  {
	    /*
	     * 2) actualizo el valor de Active = 1 en la tabla "people"
	     */
	    $sql1 = "UPDATE `people` SET Active = 1 WHERE idPeople = $idPeople";
	    if ($conn->query($sql1) === TRUE) 
	    {
	    	$data->success = true;
		    $data->msj     = " Felicitaciones, tu cuenta ha sido activada!";
		    $data = json_encode($data); 
		    echo $data;
		    exit();     
			    
	    }
	    else
	    {
	      	$data->success = false; 
		    $data->msj     = " No se ha podido actualizar el estado!";
		    $data = json_encode($data); 
		    echo $data;
		    exit();     
	    }

	  } 
	  else 
	  {
		$data->success = false; 
	    $data->msj     = "No se ha podido actualizar el estado!";
	    $data = json_encode($data); 
	    echo $data;
	    exit();     
	  }
	}
	else
	{
		$data->success = false; 
	    $data->msj     = "Ya es una cuenta activa";
	    $data = json_encode($data); 
	    echo $data;
	    exit();     
	}

  $conn->close();

}
?>

      
    

