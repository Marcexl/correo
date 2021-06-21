<?php
/*
 * mixed by marcexl
 * version 17062021
 * 
 * archivo que controla si es un token válido
 */
session_start();

/* traigo el bearer_token */
$header = apache_request_headers();   

/* 
 * existe la sesion iniciada?
 */
$data   = new \stdClass();
$idAuth = '';

if( (isset($header['Authorization'])) and (isset($_REQUEST['email'])) )
{
	$bearer_token = str_replace("Bearer ","",$header['Authorization']);
	$email_req 	  = $_REQUEST['email'];

	$sqlAuth = "SELECT p.idPeople 
				FROM `people` p, `token` t 
				WHERE p.idPeople = t.idPeople 
				AND p.Email = '$email_req'
				AND t.Token = '$bearer_token'";
	$result  = $conn->query($sqlAuth); 

	if ($result && $result->num_rows > 0) 
	{
	    while($rowAuth = $result->fetch_assoc()) 
	    {
	      $idAuth = $rowAuth['idPeople'];
	    }
	}
	else 
	{			
	
		/* si no coincide */
		$data->success = false;
		$data->code    = 403;
		$data->msj     = utf8_encode("El token no es valido.");
	    echo json_encode($data);
	    exit();
	}
}
else
{
	$data->success = false;
	$data->msj     = "Sesion no iniciada";
	$data->code    = 401;
	session_destroy();
	echo json_encode($data);
	exit();
}

?>