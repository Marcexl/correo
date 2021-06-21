/*
 * remixed by Marcexl 
 * version 18052020
 */

function sendDatosPersonales(){

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = $("#form-nameandage").serialize() + "&email="+email;
  let url = path+'ajax/actDatosPersonales.php';

  $.ajax({
    type: 'POST',
    url: url,
    data: dataString,
    headers: {'Authorization': 'Bearer '+token},   
    error: function (res){
      console.log(res);
    },
    beforeSend: function(){
      $("#loader").fadeIn();
      $("#nameandage-button").fadeOut();
    },
    success: function(res){
      let data = JSON.parse(res);
      $("#loader").fadeOut(); 
      
      if(data['success'] == true)
      {
        checkTutorial();
      }
      else
      {
        $("#nameandage-button").fadeIn();
        let msj = data['msj'];
        let alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
        $("#alert-msj").show().html(alert);
        return false;
      }
    }
  });
}

function getProvincias(){

  let url = path+'ajax/getProvincias.php';
  let dataString = "&provincia=";

  $.ajax({
    type: 'GET',
    url: url,
    data: dataString, 
    error: function (res){
      console.log(res);
    },
    beforeSend: function(){
      /**/
    },
    success: function(res){
      
      $("#provincia").html(res);
    
    }
  });
}

function getLocalidades()
{
  
  let idProvincia = $("#provincia").val();
  let url = path+'ajax/getLocalidades.php';
  let dataString = "&provincia="+idProvincia+"&localidad=";

  $.ajax({
    type: 'GET',
    url: url,
    data: dataString, 
    error: function (res){
      console.log(res);
    },
    beforeSend: function(){
      /**/
    },
    success: function(res){
      if(res !== '')
      {
        $("#localidad").html(res).prop("disabled",false);
      }
    }
  });
}