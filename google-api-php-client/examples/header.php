<?php
/* Made by Marcexl 2015
 * version 26082015
 * all rights reserved by www.marcexl.com.ar
 * colors, logos and design by Melagna
 */ 
?>
<html>
	<head>
		<meta name="google-site-verification" content="d31nqAM70yut2quFAdzTJC0v5xbidy-qOs3v7BA3Iyc" />
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title><?php echo $title;?></title>
		<meta name="description" content="Ofrecemos servicio de paginas web, diseño, programación y mantenimiento." />
		<meta name="keywords" content="Programacion web, diseño web, servicio de mantenimiento, responsive, css3, html5, php, mysql, jquery." />
		<meta name="author" content="Marcelo Gallardo">
		<link rel="shortcut icon" href="img/logos/logo_mxl.ico">
		<link rel="stylesheet" type="text/css" href="css/mxlstyle.css" />
		<link rel="stylesheet" type="text/css" href="css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="css/menu.css" />
		<link rel="stylesheet" type="text/css" href="css/slider.css" />
		<link rel="stylesheet" type="text/css" href="css/responsive.css" />
		<script src="js/jquery-latest.min.js"></script>
		<script>
	    $(document).ready(function(){
	        $(".iconoMenuDesplegable").click(function(){
	            if($("#menuMobile").is(":visible"))
	            {
	                $("#menuMobile").slideUp("slow");
	                $(".iconoMenuDesplegable").removeClass("efecto");
	            }else{
	                $("#menuMobile").slideDown("slow");
	                $(".iconoMenuDesplegable").addClass("efecto");
	            }
	        });
	    });
	    </script>
</head>
	<body>
		<div class="wrapper">
		<div id="logo">
			<img src="img/logos/logo_mxl.png">
		</div>
		<div class="userId"><?php echo $me["displayName"]; echo '&nbsp;&nbsp;<img src='.$me["image"]["url"].' width="25" class="avatar">'; ?></div>
		<!--for mobile-->
		<div id="logoMobile">
			<img src="img/logos/logo_mxl.png">
		</div>


