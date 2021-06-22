<?php
ob_start();
session_start();
/*
 * mixed by marcexl
 * version 22062021
 */

include_once ("config/config.php");
include_once ("config/conexion.php");
include_once ("config/funciones.php");
if(isset($_SESSION['access_token']))
{
	/* elimino la session de google */
	unset($_SESSION['access_token']);
}

include_once("inc/header.php");

?>
	 <section id="activation" style="display:none;">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card card-signin flex-row my-5">
            <div class="card-body">
              <h5 class="card-title text-center" id="message-activation">
              Esperamos verte pronto...</h5>
              </div>
          </div>
        </div>
      </div>
    </section><!-- end of activation -->

    <!-- JS Library @bymarcexl -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
    	$(document).ready(function(){
		  kill();
		});

    	function kill(){
		  $("#loader").fadeIn();
		  $("#activation").fadeIn();

		  localStorage.removeItem("people");
		  setTimeout(function(){
		    location = "index.php";
		  },1500);
		}
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    </body>
</html>
<?php
ob_end_flush();
?>

