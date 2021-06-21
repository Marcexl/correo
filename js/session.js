
/*
 * remixed by Marcexl 
 * version 18062021
 */

$(document).ready(function(){
  isLogged();
});


function isLogged(){
  if(localStorage.getItem("people"))
  {
    checkStatus();
  }
}

function initSession(token,email){
  /* 
   * por las dudas chequeo haber matado 
   * el prepeople 
   */
  if(localStorage.getItem("prepeople"))
  {
    localStorage.removeItem("prepeople");
  }

  /* inicio session*/
  var usrJson = {token:''+token+'',email:''+email+''};
  localStorage.setItem("people",JSON.stringify(usrJson));
  $("#myModal").fadeOut();
  $("#alert-msj").fadeOut();
  
  /* inicio secuencia de chequeo */
  checkStatus();
}

function signOut(){

  var modal  = '';
      modal += '<div class="modal-dialog" role="document">';
      modal += '<div class="modal-content">';
      modal += '<div class="modal-header">';
      modal += '<h5 class="modal-title">Cerrar sesión</h5>';
      modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal();">';
      modal += '<span aria-hidden="true">&times;</span>';
      modal += '</button>';
      modal += '</div>';
      modal += '<div class="modal-body">';
      modal += '<p>¿Estás seguro que querés cerrar sesión?</p>';
      modal += '</div>';
      modal += '<div class="modal-footer">';
      modal += '<button type="button" class="btn btn-primary" onclick="kill();">Salir</button>';
      modal += '<button type="button" class="btn btn-secondary close-modal" onclick="closeModal();" id="close-modal" data-dismiss="modal">Cancelar</button>';
      modal += '</div>';
      modal += '</div>';
      modal += '</div>';

  $("#modal-msj").fadeIn().html(modal);

}

function kill(){
  $("#loader").fadeIn();

  localStorage.removeItem("people");
  setTimeout(function(){
    location.reload();
  },1500);
}
