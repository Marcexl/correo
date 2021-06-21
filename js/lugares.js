/*
 * remixed by Marcexl 
 * version 21062021
 */

function lugares()
{ 
  $("section").fadeOut();

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = '&email='+email;
  let url = path+'ajax/getLugares.php';

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
      if(res == '')
      {
        $("#lugares").fadeIn();
        $("#listado-lugares").hide();
        $("#emoji").show();
      }
      else
      {
        $("#lugares").fadeIn();
        $("#emoji").hide();
        $("#listado-lugares").show();
        $("#listado-lugares").dataTable({
          "order": [[ 1, "asc" ]],
          "searching": false,
          "paginate":false,
          "info":false
        });
        $("#listado-result").html(res);
      }
    }
  });
}

function agregarLugar()
{ 
  $("section").fadeOut();

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let url = path+'ajax/agregarLugar.php';
  let dataString = $("#form-lugares").serialize() + '&email='+email;
 
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
        let alert = '<div class="alert alert-success" role="alert">Se ha agregado el lugar!</div>';
        $("#alert-msj").show().html(alert);
        setTimeout(function(){
          $("#alert-msj").fadeOut();
          lugares();
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

function deleteLugar(idLugar)
{ 

  var r = confirm("Realmente deseas eliminar este lugar?");
  if (r == true) 
  {
    let usrInfo = JSON.parse(localStorage.getItem("people"));
    let token   = usrInfo.token;  
    let email   = usrInfo.email;  
    let dataString = "&idLugar="+idLugar+"&email="+email;
    let url = path+'ajax/deleteLugar.php';
   
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
          let alert = '<div class="alert alert-success" role="alert">Se ha eliminado el lugar!</div>';
          $("#alert-msj").show().html(alert);
          setTimeout(function(){
            $("#alert-msj").fadeOut();
            lugares();
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
  else 
  {
    /* nada */
  }
  
}