<?php
/*
 * mixed by marcexl
 * version 17062021
 * 
 * archivo de funciones generales del sistema
 */

function generaToken($qtd)
{ 
	/*
	 * funcion que genera el token de 
	 * 30 caracteres alfanumericos 
	 */
  $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
  $QuantidadeCaracteres = strlen($Caracteres); 
  $QuantidadeCaracteres--; 

  $token=NULL; 
      for($x=1;$x<=$qtd;$x++){ 
          $Posicao = rand(0,$QuantidadeCaracteres); 
          $token .= substr($Caracteres,$Posicao,1); 
      } 

  return $token; 
}

function checkIfExist($email)
{
	GLOBAL $conn;
	/*
	 * funcion que chequea si existe el email
	 * devuelve 
	 * 0 = no existe;
	 * 1 = existe pero no esta activado
	 * 2 = existe y esta activado 
	 */
	$idPeople = '';
	$active   = '';
	$res   	  = '';

	$sql = "SELECT idPeople, Active 
			    FROM `people` 
          WHERE Email = '$email'";
	$resultado = $conn->query($sql); 

	while ($row = $resultado->fetch_assoc()) 
	{
  		$idPeople = $row['idPeople'];
  		$active   = $row['Active'];
	}

	if(empty($idPeople))
	{
		$res = 0;
		return $res;
	}

	if($active == 0)
	{
		$res = 1;
		return $res;
	}

	if($active == 1)
	{
		$res = 2;
		return $res;
	}

}

function checkIfUserExist($user)
{
  GLOBAL $conn;
  /*
   * funcion que chequea si existe el usuario
   * devuelve 
   * 0 = no existe
   * 1 = existe
   */
  $idPeople = '';
  $res      = '';

  $sql = "SELECT idPeople 
          FROM `people` 
          WHERE Username = '$user'";
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
      $idPeople = $row['idPeople'];
  }

  if(empty($idPeople))
  {
    $res = 0;
  }
  else
  {
    $res = 1;
  }
  
  return $res;
}


function getIdPeople($email)
{
	/*
     * obtiene el IdPeople 
     * desde el email
     */
  GLOBAL $conn;

  $sql = "SELECT idPeople FROM `people` WHERE Email = '$email'";
  
  $resultado = $conn->query($sql); 

  while ($row = $resultado->fetch_assoc()) 
  {
    $idPeople = $row['idPeople'];
  }

  return $idPeople;
}

function checkUser($useremail)
{
  	
  GLOBAL $conn;
	
	/*
	 * busca si existe el email para logearse
	 * devuelve json false
	 * devuelve email si es true
	 */

	$data = new \stdClass();
  $useremail2 = '';

	$sql = "SELECT Email 
          FROM `people`
          WHERE Email = '$useremail'";

  $resultado = $conn->query($sql); 

	if ($resultado && $resultado->num_rows > 0) 
	{
    while($row = $resultado->fetch_assoc()) 
    {
      $useremail2 = $row['Email'];
    }
  }
  else 
  {
    $data->success = false;
    $data->msj = "El nombre de usuario es incorrecto.";
    $data = json_encode($data);
    echo $data;
    exit();
	}

	return $useremail2;
}

function checkPass($userpass,$useremail2)
{
  GLOBAL $conn;
  
  /*
   * busca si existe la contraseña para logearse
   * devuelve json false
   * devuelve idPeople si es true
   */

  $data = new \stdClass();
  $idPeople = '';
  $sql = "SELECT idPeople 
          FROM `people`
          WHERE Pass = '$userpass' 
          AND Email = '$useremail2'";
  $resultado = $conn->query($sql);
  if ($resultado && $resultado->num_rows > 0) 
  {
    while($row = $resultado->fetch_assoc()) 
    {
      $idPeople  = $row['idPeople']; 
    }
  }
  else
  {
    $data->success = false;
    $data->msj = "la contraseña ".$userpass." no es correcta.";
    $data = json_encode($data);
    echo $data;
    exit();
  }

  return $idPeople;
}

function checkToken($token)
{
  GLOBAL $conn;
  
  /*
   * busca si existe el token activado
   * devuelve true or false
   */

  $res = '';
  $sql = "SELECT idPeople 
          FROM `token`
          WHERE Token = '$token'";
  $resultado = $conn->query($sql);
  if ($resultado && $resultado->num_rows > 0) 
  {
    $row = $resultado->fetch_assoc();
    $idPeople  = $row['idPeople'];
    $res       = 1; 
    
  }
  else
  {
    $res = 0;
  }

  return $res;
}

function getToken($idPeople)
{
  GLOBAL $conn;
  
  /*
   * busca el token del idPeople para logearse
   * devuelve json false
   * devuelve json true
   */

  $data = new \stdClass();

  $token = '';

  $sql = "SELECT Token FROM `token` 
          WHERE idPeople = $idPeople 
          AND Active = 1";
  $resultado = $conn->query($sql); 
  if ($resultado->num_rows > 0)
  {
    while($row = $resultado->fetch_assoc()) 
    {
    
      $token          = $row['Token'];
      $data->success  = true;
      $data->token    = $token;
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

function getAvatar($idPeople)
{
  GLOBAL $conn;
  
  /*
   * funcion que obtiene
   * el avatar de la persona
   */

  $avatar = '';
 
  $sql = "SELECT Avatar 
          FROM `people`
          WHERE idPeople = $idPeople 
          AND Active = 1";
  
  $resultado = $conn->query($sql); 
  $row = $resultado->fetch_assoc();
  $avatar = $row['Avatar'];
  
  return $avatar;
}

?>