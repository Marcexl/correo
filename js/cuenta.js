/*
 * remixed by Marcexl 
 * version 18062021
 */

function getDatosCuenta()
{ 
  $("section").fadeOut();

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = '&email='+email;
  let url = path+'ajax/getDatosCuenta.php';

  $.ajax({
    type: 'GET',
    url: url,
    data: dataString,
    headers: {'Authorization': 'Bearer '+token},
    error: function (res){
      console.log(res);
    },
    beforeSend: function(){
    },
    success: function(res){
      $("#cuenta").fadeIn();
      let data = JSON.parse(res);
      if(data['success'] == true)
      {

        let avatar   = data['avatar'];
        let username = data['username'];
        let pass     = data['pass'];
        let lname    = data['lname'];
        let fname    = data['fname'];
        let edad     = data['edad'];
        let gender   = data['gender'];
        let loca     = data['loca'];
        let prov     = data['prov'];

        $("#cuenta-avatar").attr("src","img/avatar/"+avatar);
        $("#cuenta-user").val(username);
        $("#cuenta-email").html(email);
        $("#cuenta-pass").val(pass);
        $("#cuenta-lname").val(lname);
        $("#cuenta-fname").val(fname);
        $("#cuenta-edad").val(edad);
        $("#cuenta-gender").val(gender);
        setProvincia(prov);
        setTimeout(function(){
         setLocalidad(loca);
        },300);
      }
    }
  });
  
}

function revealPass(){
  let pwd = $("#cuenta-pass");
  if (pwd.attr('type') === 'password') 
  {
    pwd.attr('type', 'text');
  } 
  else
  {
    pwd.attr('type', 'password');
  }
}

function guardarCuenta(){
  $("#cuenta-form").submit();
}

$("#cuenta-form").validate({
  rules: {
    'cuenta-user': {required: true, minlength:4}, 
    'cuenta-pass': {required: true, minlength:8},
    'cuenta-fname': {required: true, minlength:2},
    'cuenta-lname': {required: true, minlength:2},
    'cuenta-edad': {required: true},
    'cuenta-gender': {required: true},
    'provincia-c': {required: true},
    'localidad-c': {required: true}
    },
  
  messages: {
    'cuenta-user': "", 
    'cuenta-pass': "",
    'cuenta-fname': "",
    'cuenta-lname': "",
    'cuenta-edad': "",
    'cuenta-gender': "",
    'provincia-c': "",
    'localidad-c': ""
  },

  submitHandler: function(form){
    $("#loader").fadeIn();
    let usrInfo = JSON.parse(localStorage.getItem("people"));
    let token   = usrInfo.token;  
    let email   = usrInfo.email;  
    let url = path+'ajax/sendDatosCuenta.php';
    let dataString = $("#cuenta-form").serialize() + '&email='+email;

    $.ajax({
      type: 'POST',
      url: url,
      data: dataString,
      headers: {'Authorization': 'Bearer '+token},  
      error: function (res){
        console.log(res);
      },
      beforeSend: function(){
        $("#register-button").fadeOut();
      },
      success: function(res){
        $("#loader").fadeOut();

        let data = JSON.parse(res);
        
        if(data['success'] == true)
        {
          let alert = '<div class="alert alert-success" role="alert">Se han actualizado los datos!</div>';
          $("#alert-msj").show().html(alert);
          setTimeout(function(){
            $("#alert-msj").fadeOut();
            getDatosCuenta();
          },2000);
        }
        else
        {
          let msj = data['msj'];
          let alert = '<div class="alert alert-warning" role="alert">'+msj+'</div>';
          $("#alert-msj").show().html(alert);
          setTimeout(function(){
            $("#alert-msj").fadeOut();
          },3000);
        }
      }
    })//ajax
  }
})




function setProvincia(prov){

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
      
      $("#provincia-c").html(res);
      $("#provincia-c").val(prov);
      
    }
  });
}

function setLocalidad(loca)
{
  
  let idProvincia = $("#provincia-c").val();
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
        $("#localidad-c").html(res).prop("disabled",false);
        $("#localidad-c").val(loca);
      }
    }
  });
}