/*
 * remixed by Marcexl 
 * version 18062021
 */

const msg  = "Campo requerido";
const msg1 = "Indique un email valido";
//path = "https://www.marcexlweb.com/correo/app/ajax/";
path = "";

/* 
 * funcion que activa el modal para logeo
 */
function signInForm()
{
  $("#myModal").show();
}

/*
 * funcion que logea con email y pass
 * player 1 o player 2
 */
function signPeople()
{
  $("#sign-form").submit();
}

$("#sign-form").validate({
  rules: {
    'useremail': {required: true}, 
    'userpass': {required: true}
    },
  
  messages: {
    'useremail': "",
    'userpass': ""
  },

  submitHandler: function(form){

    let url = path+'ajax/initSession.php';
    let dataString = $("#sign-form").serialize();

    $("#loader").fadeIn();

    $.ajax({
      type: 'POST',
      url: url,
      data: dataString,
      error: function (res){
        console.log(res);
      },
      beforeSend: function(){
        $("#sign-button").removeClass("btn-primary");
        $("#sign-button").addClass("btn-secondary");
        $("#sign-button").prop("disabled", true);
      },
      success: function(res){
        $("#loader").fadeOut();
        let data = JSON.parse(res);
        if(data['success'] == true)
        {
          let token = data['token'];
          let email = data['email'];
          let alert = '<div class="alert alert-success" role="alert">Great, welcome!</div>';
          $("#alert-msj").show().html(alert);
          initSession(token,email);
        }
        else
        {
          let msj = data['msj'];
          let alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
          $("#alert-msj").show().html(alert);
          reloadForm();
          return false;
        }
      }
    })//ajax
  }
})


/* 
 * funcion que registra a la persona 
 */
function registerPeople()
{ 
  $("#form-register").submit();
}

$("#form-register").validate({
  rules: {
    'username': {required: true}, 
    'useremail1': {required: true},
    'userpass1': {required: true, minlenght:8}
    },
  
  messages: {
    'username':  "",
    'useremail1': "",
    'userpass1': ""
  },

  submitHandler: function(form){

    let url = path+'ajax/registerPeople.php';
    let dataString = $("#form-register").serialize();

    $("#loader").fadeIn();

    $.ajax({
      type: 'POST',
      url: url,
      data: dataString,
      error: function (res){
        console.log(res);
      },
      beforeSend: function(){
        $("#register-button").removeClass("btn-primary");
        $("#register-button").addClass("btn-secondary");
        $("#register-button").prop("disabled", true);
      },
      success: function(res){
        $("#loader").fadeOut();
        let data = JSON.parse(res);
        if(data['success'] == true)
        {
          if(data['code'] == 1)
          {
            let msj = data['msj'];
            let alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
            $("#alert-msj").show().html(alert);
            reloadForm();

            return false;
          }

          if(data['code'] == 2)
          {
            let msj = data['msj'];
            let alert = '<div class="alert alert-warning" role="alert">'+msj+'</div>';
            $("#alert-msj").show().html(alert);
            reloadForm();
            return false;
          }
          let token = data['token'];
          let email = data['email'];

          /* 
           * activo la cuenta
           */
          activate(token,email);
        }

      }
    })//ajax
  }
})

function reloadForm(){
  setTimeout(function(){
    $("form")[0].reset();
    $("#alert-msj").fadeOut();
    $("#register-button").prop("disabled", false);
    $("#register-button").removeClass("btn-secondary");
    $("#register-button").addClass("btn-primary");

    $("#sign-button").prop("disabled", false);
    $("#sign-button").removeClass("btn-secondary");
    $("#sign-button").addClass("btn-primary");
  },3000);
}


$(document).ready(function(){

  $(".error").click(function(){
    $(this).hide();
  });

  const container  = $(".modal-login");
  const container1 = $(".alert");
  const container2 = $("#modal-msj");

  /* 
   * 1) cierra al hacer click 
   */
  $(".modal-login .close").click(function(){
    $("#myModal").fadeOut();
  });

  /* 
   * 2) cierra al hacer click fuera del div
   */

  $(document).mouseup(function(e){

      if (!container.is(e.target) && container.has(e.target).length === 0) 
      {
          $("#myModal").fadeOut();
      }

      if (!container1.is(e.target) && container1.has(e.target).length === 0) 
      {
          $("#alert-msj").fadeOut();
      }

      if (!container2.is(e.target) && container2.has(e.target).length === 0) 
      {
          $("#modal-msj").fadeOut();
      }
  });

  /* 
   * 3) cierra al presionar la tecla ESC
   */

  $(document).on('keydown',function(e){
      if (e.keyCode === 27 ) { 
          $("#myModal").fadeOut();
          $("#alert-msj").fadeOut();
      }
  });

});

function activate(token, email){
  $("#login").fadeOut();
  $("#activation").fadeIn();

  let dataString = "&token="+token+"&email="+email;
  let url = path+'ajax/activation.php?'+dataString;
  $.ajax({
      type: 'POST',
      url: url,
      data: dataString,
      error: function (res){
        console.log(res);
      },
      beforeSend: function(){
        /**/
      },
      success: function(res){
        let data = JSON.parse(res);
        if(data['success'] == true)
        {
          let msj = data['msj'];
          let alert = '<div class="alert alert-success" role="alert">'+msj+'</div>';
          $("#alert-msj").show().html(alert);
          initSession(token,email);
        }
        else
        {
          let msj = data['msj'];
          let alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
          $("#alert-msj").show().html(alert);
          reloadForm();
          return false;
        }
      }
    })//ajax
}