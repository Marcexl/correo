/*
 * remixed by Marcexl 
 * version 18062021
 */

function checkerror(code){
  let error = code;
  if(error == 403)
  {
    $("section").fadeOut();
    let msj = 'No es un usuario autorizado';
    let alert = '<div class="alert alert-warning" role="alert">'+msj+'</div>';
    $("#alert-msj").show().html(alert);
    localStorage.removeItem("people");
    setTimeout(function(){
      location.reload();
    },1500);
    return false;
  }
}; 

function closeModal(){
  $("#modal-msj").fadeOut();
}

function getNotify(){
  $("section").fadeOut();
  setTimeout(function(){
    $("#notificaciones").fadeIn();
  },500);
}