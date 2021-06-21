<?php
/*
 * mixed by marcexl
 * version 17062021
 * 
 * archivo que tiene la conexion
 */

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>