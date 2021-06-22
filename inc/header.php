<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <meta name="color-scheme" content="light dark">
    <meta name="google-signin-client_id" content="292706438987-lj4h9m0cimg0m83h1a0cn4fat34ptooq.apps.googleusercontent.com">
    <meta name="color-scheme" content="light dark">
    
    <!-- librerias css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/material-icons.css" rel="stylesheet" type="text/css">
    <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/dataTable.css" />
    
    <!-- css @bymarcexl -->
    <link href="css/style.css?anio=2021" rel="stylesheet" type="text/css">

    <!-- for google signin -->
    <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
    <link rel="shortcut icon" href="img/felico.ico" />
    <title>¿Dónde esta Felipe?</title>
</head>
  <body>

    <!-- alerts -->
    <div id="alert-msj" style="display:none;"></div>
    
    <!-- loader -->
    <div id="loader">
      <div class="spinner-border" role="status" >
        <span class="sr-only"></span>
      </div>
      <div class="loader-msj" id="loader-msj"></div>
    </div>

    <!-- ir arriba -->
    <div class="ir-arriba">
      <a href="#"><i class="material-icons">keyboard_arrow_up</i></a>
    </div>

    <!-- modal msj -->
    <div class="modal" tabindex="-1" role="dialog" id="modal-msj" style="display:none;"></div>