<?php
ob_start();
/*
 * mixed by marcexl
 * version 22062021
 * for destroy session
 */

session_start();
session_destroy();


header("location:index.php");

ob_end_flush();	
?>