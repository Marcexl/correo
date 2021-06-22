/*
 * remixed by Marcexl 
 * version 22062021
 * for login with google oauth
 */

function initGoogleSession(token,email){
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
  location = 'index.php';
  return false;
}
