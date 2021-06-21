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

        $("#cuenta-avatar").attr("src","img/avatar/"+avatar);
        $("#cuenta-user").val(username);
        $("#cuenta-email").html(email);
        $("#cuenta-pass").val(pass);
        $("#cuenta-lname").val(lname);
        $("#cuenta-fname").val(fname);
        $("#cuenta-edad").val(edad);
        $("#cuenta-gender").val(gender);
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

function guardarCuenta()
{
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
  });
}