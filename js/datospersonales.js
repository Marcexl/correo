/*
 * remixed by Marcexl 
 * version 18052020
 */

function sendDatosPersonales(){
  $("#form-datospersonales").submit();
}

$("#form-datospersonales").validate({
  rules: {
    'userfname': {required: true, minlength:2}, 
    'userlname': {required: true, minlength:2},
    'gender': {required: true},
    'useredad': {required: true},
    'provincia': {required: true},
    'localidad': {required: true}
    },
  
  messages: {
    'userfname': "",
    'userlname': "",
    'gender': "",
    'useredad': "",
    'provincia': "",
    'localidad': ""
  },

  submitHandler: function(form){
    $("#loader").fadeIn();

    let usrInfo = JSON.parse(localStorage.getItem("people"));
    let token   = usrInfo.token;  
    let email   = usrInfo.email;  
    let url = path+'ajax/actDatosPersonales.php';
    let dataString = $("#form-datospersonales").serialize() + "&email="+email;

    $("#loader").fadeIn();

    $.ajax({
      type: 'POST',
      url: url,
      data: dataString,
      headers: {'Authorization': 'Bearer '+token},  
      error: function (res){
        console.log(res);
      },
      beforeSend: function(){
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
    })//ajax
  }
})

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

function getLocalidades(div)
{
  if(div == 1)
  {
    var idProvincia = $("#provincia-c").val();
  }
  else
  {
    var idProvincia = $("#provincia").val();
  }

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
        if(div == 1)
        {
          $("#localidad-c").html(res).prop("disabled",false);
        }
      }
    }
  });
}