<?php
/* 
 * mixed by marcexl
 * version 21122020
 * get basic profile of the people
 *
 */

include_once("../config/config.php");
include_once("../config/conexion.php");
include_once("../config/funciones.php");
include_once("../config/authenticate.php");

$data 	= new \stdClass();
$dir 	= '../img/avatar';
$result = '';

if(isset($_GET['email']))
{
   $token    = $bearer_token;
   $email    = $_GET['email'];

   $idPeople = getIdPeople($email);
   $idAvatar = getAvatar($idPeople);
   $cdir = scandir($dir);
   $a = '';
   foreach ($cdir as $key => $value)
   {

      if (!in_array($value,array(".","..","0.png")))
      {
         $a = str_replace(".png","",$value);
         if($a == $idAvatar)
         {
            $result .= '<div class="avatar-item"><img src="'.$http.'/img/avatar/'.$value.'" class="img-thumbnail active" id="avatar-'.$a.'"></div>';
         }
         else
         {
            $result .= '<div class="avatar-item"><img src="'.$http.'/img/avatar/'.$value.'" class="img-thumbnail" id="avatar-'.$a.'" onclick="selectAvatar('.$a.')"></div>';
         }

      }
   }
  
   echo $result;
}

?>