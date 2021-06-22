<?php
/*
 * mixed by marcexl
 * version 17062021
 */
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <meta name="color-scheme" content="light dark">
    <meta name="google-signin-client_id" content="706842631309-bnj8q7e2ofbcu4tbnrq0vmctkt67vrf6.apps.googleusercontent.com">
    <meta name="color-scheme" content="light dark">
    
    <!-- librerias css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/material-icons.css" rel="stylesheet" type="text/css">
    <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/dataTable.css" />
    
    <!-- css @bymarcexl -->
    <link href="css/style.css?anio=2021" rel="stylesheet" type="text/css">

    <!--script src="https://apis.google.com/js/platform.js" async defer></script-->
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

    <!-- header navbar -->
    <nav class="navbar sticky-top navbar-dark bg-blue" id="header-menu" style="display:none;">
      <a class="navbar-brand" href="#">Panel de control</a>
      <div id="icon-bell" onclick="getNotify()">
        <i class="fas fa-bell"></i>
      </div>
       <!--div id="icon-menu">
        <i class="material-icons">menu</i>
      </div-->
    </nav>

    <!-- Login modal -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog modal-login">
        <div class="modal-content">
          <div class="modal-header">
            <div class="avatar">
               <i class="fas fa-user"></i>
            </div>        
            <h4 class="modal-title">Ingresar al sitio</h4> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <form id="sign-form">
              <div class="form-label-group">
                <input type="email" id="useremail" name="useremail" class="form-control" placeholder="Email" required>  
              </div>
              <div class="form-label-group">
                <input type="password" class="form-control" name="userpass" placeholder="Contraseña" required> 
              </div>        
              <div class="form-label-group">
                <button type="button" id="sign-button" class="btn btn-lg btn-primary btn-block text-uppercase" onclick="signPeople()">Ingresar</button>  
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="#" onclick="forgotPassword()">Olvidaste la contraseña?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- sections -->
    <section id="login">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-img-left d-none d-md-flex">
               <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body">
              <h1 class="text-center">¿Dónde esta Felipe?</h1>
              <h5 class="card-title text-center">Se suele escapar seguido esperemos que este bien...</h5>
              <form class="form-signin" id="form-register">
                <div class="form-label-group">
                  <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de usuario" required autofocus>
                </div>

                <div class="form-label-group">
                  <input type="email" id="useremail1" name="useremail" class="form-control" placeholder="Email" required>
                </div>
                
                <div class="form-label-group">
                  <input type="password" id="userpass1" name="userpass" class="form-control" placeholder="Contraseña: mínimo 8 caracteres"  minlenght="8" required>
                </div>
                
                <hr>
                
                <button class="btn btn-lg btn-primary btn-block text-uppercase" id="register-button" type="button" onclick="registerPeople()">Registrame</button>

                <a class="d-block text-center mt-2 small" href="#" onclick="signInForm()">Ingresar con cuenta felipe</a>
                <hr class="my-4">
                <p align="center">O ingresá con tu cuenta de Google.</p>
                <button class="btn btn-lg btn-google btn-block text-uppercase"type="button"><i class="fab fa-google mr-2"></i> Ingresar con Google</button>
               
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of login -->

    <section id="activation" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center" id="message-activation">
              Estamos registrando tu cuenta...</h5>
              </div>
          </div>
        </div>
      </div>
    </section><!-- end of activation -->

    <section id="avatargallery" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Seleccioná un avatar</h5>
              <div id="avatargallery-result"></div>
              <div class="form-label-group" align="center">
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button" id="avatar-button" onclick="checkDatosPersonales()">Siguiente</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of avatargallery -->

    <section id="datospersonales" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Ya falta poco, necesitamos que completes estos últimos datos</h5>
              <form class="form-signin" id="form-datospersonales">
                <div class="form-label-group">
                  <input type="text" id="userfname" name="userfname" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="form-label-group">
                  <input type="text" id="userlname" name="userlname" class="form-control" placeholder="Apellido" required>
                </div>
                <div class="form-label-group">
                  <select class="form-select" id="gender" name="gender" required>
                    <option value="">Elegí una opción</option>
                    <option value="1">Masculino</option> 
                    <option value="2">Femenino</option> 
                    <option value="3">Otro</option> 
                  </select>
                </div>
                <div class="form-label-group">
                  <input type="number" id="useredad" name="useredad" class="form-control" placeholder="Edad" min="16" max="99" required>
                </div>
                <div class="form-label-group">
                  <select id="provincia" name="provincia" class="form-select" required onchange="getLocalidades()"></select>
                </div>
                <div class="form-label-group">
                  <select id="localidad" name="localidad" class="form-select" required disabled></select>
                </div>
        
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button" id="nameandage-button" onclick="sendDatosPersonales()">Siguiente</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of datospersonales -->

    <section id="lugares" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center ">Lista de lugares preferidos de Felipe</h5>
              <form class="form-signin" id="form-lugares">
                <div class="form-label-group">
                  <input type="text" id="lugar" name="lugar" class="form-control" placeholder="Lugar por ej: Sillón" required>
                </div>
        
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button" id="lugares-button" onclick="agregarLugar()">Agregar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center mb-0">Listado</h5>
              <img src="img/empty.gif" id="emoji">
              <p class="text-center" id="emoji-text">Ups! Nada por aqui...</p>
              <table class="display" id="listado-lugares">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Lugar</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody id="listado-result">
                </tbody>
              </table>
              <p align="center">
                  <button class="btn btn-lg btn-secondary btn-block text-uppercase" id="register-button" type="button" onclick="gameStart()">Volver</button>
                </p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of datospersonales -->

    <section id="main-menu" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center">¿Dónde esta Felipe hoy?</h5>
                <div class="main-menu-options"> 
                  <a href="javascript:void(0);" class="main-menu-item" id="m-m-1" onclick="whereIs();">
                    <i class="material-icons">location_on</i> 
                    <span class="material-text">Donde</span>
                  </a>  
                  <a href="javascript:void(0);" class="main-menu-item" id="m-m-2" onclick="lugares();"> 
                    <i class="material-icons">list</i> 
                    <span class="material-text">Lugares</span>
                  </a> 
                  <a href="javascript:void(0);" class="main-menu-item" id="m-m-3" onclick="getDatosCuenta();"> 
                    <i class="material-icons">
                      manage_accounts
                    </i>
                    <span class="material-text">Cuenta</span>
                  </a> 
                  <a href="javascript:void(0);" class="main-menu-item" id="m-m-4" onclick="signOut();"> 
                    <i class="material-icons">logout</i>
                    <span class="material-text">Salir</span>
                  </a>  
                </div>
                <div class="form-label-group">
                  <img src="" id="main-avatar">
                </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of main menu -->


    <section id="cuenta" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Mi cuenta</h5>
              <form id="cuenta-form" name="cuenta-form">
                <div class="form-label-group">
                  <img src="" id="cuenta-avatar" onclick="avatargallery()">
                </div>
                <div class="form-label-group">
                  <input type="text" id="cuenta-user" name="cuenta-user" class="form-control">
                </div>
                <div class="form-label-group">
                  <div id="cuenta-email" class="form-control"></div>
                </div>
                <div class="form-label-group">
                  <input type="password" id="cuenta-pass" name="cuenta-pass" class="form-control" required>
                  <span class="input-group-btn" >
                    <button class="btn btn-default reveal" onclick="revealPass()" type="button"><i class="fas fa-eye"></i></button>
                  </span>     
                </div>
                <hr>
                <div class="form-label-group">
                  <input type="text" id="cuenta-fname" name="cuenta-fname" class="form-control">
                </div>
                <div class="form-label-group">
                  <input type="text" id="cuenta-lname" name="cuenta-lname" class="form-control">
                </div>
                <div class="form-label-group">
                  <input type="number" id="cuenta-edad" name="cuenta-edad" class="form-control" min="16" max="99">
                </div>
                <div class="form-label-group">
                  <select class="form-select" id="cuenta-gender" name="cuenta-gender">
                    <option value="1">Masculino</option> 
                    <option value="2">Femenino</option> 
                    <option value="3">Otro</option> 
                  </select>
                </div>
                <div class="form-label-group">
                  <select id="provincia-c" name="provincia" class="form-select" required onchange="getLocalidades(1)"></select>
                </div>
                <div class="form-label-group">
                  <select id="localidad-c" name="localidad" class="form-select" required ></select>
                </div>
              </form>
                <p align="center">
                  <button class="btn btn-lg btn-secondary btn-block text-uppercase" id="register-button" type="button" onclick="gameStart()">Volver</button>

                  <button class="btn btn-lg btn-primary btn-block text-uppercase" id="register-button" type="button" onclick="guardarCuenta()">Guardar</button>
                </p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section><!-- end of cuenta -->

    <section id="notificaciones" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center" id="message-activation">
              Aun no tienes nofificaciones...</h5>
              <p align="center">
                <button class="btn btn-lg btn-secondary btn-block text-uppercase" id="register-button" type="button" onclick="gameStart()">Volver</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of notificaciones -->

    <section id="whereis" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <div class="form-label-group">
                <img src="" id="felipe">
              </div>
              <div class="form-label-group">
                <div id="stage"></div>
              </div>
               <p align="center">
                <button class="btn btn-lg btn-secondary btn-block text-uppercase" id="register-button" type="button" onclick="gameStart()">Volver</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- end of activation -->

    <!-- footer navbar   
    <nav class="navbar navbar-light bg-blue sticky-bottom fixed-bottom" id="footer-menu">
      <ul class="menu-icons">
        <li class="menu-icons-item menu-icon-active" onclick="gameStart()">
          <i class="fas fa-home" ></i>
          <span class="icon-text">Home</span>
        </li>
        <li class="menu-icons-item" onclick="getTodayResume()">
          <i class="fas fa-book"></i>
          <span class="icon-text">Resumen</span>
        </li>
        <li class="menu-icons-item" onclick="getDatosCuenta();">
          <i class="fas fa-user"></i>
          <span class="icon-text">Cuenta</span>
        </li>
        <li class="menu-icons-item" onclick="signOut();">
          <i class="fas fa-power-off"></i>
          <span class="icon-text">Salir</span>
        </li>
      </ul>
    </nav> end of footer navbar -->

    <!-- JS Jquery library -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src='js/jquery.validate.js'></script> 
    <script src='js/jquery.dataTables.js'></script> 

    <!-- JS Library @bymarcexl -->
    <script src="js/login.js?anio=2021"></script>
    <script src="js/google.js?anio=2021"></script>
    <script src="js/checkstatus.js?anio=2021"></script>
    <script src="js/avatar.js?anio=2021"></script>
    <script src="js/datospersonales.js?anio=2021"></script>
    <script src="js/cuenta.js?anio=2021"></script>
    <script src="js/lugares.js?anio=2021"></script>
    <script src="js/gamestart.js?anio=2021"></script>
    <script src="js/funciones.js?anio=2021"></script>
    <script src="js/menu.js?anio=2021"></script>
    <script src="js/session.js?anio=2021"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    </body>
</html>
