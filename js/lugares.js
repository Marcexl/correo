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
        $("#emoji-text").show();
      }
      else
      {
        $("#lugares").fadeIn();
        $("#emoji").hide();
        $("#emoji-text").hide();
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

function agregarLugar(){
  $("#form-lugares").submit();
}

$("#form-lugares").validate({
  rules: {
    'lugar': {required: true, minlength:3}
    },
  
  messages: {
    'lugar': ""
  },

  submitHandler: function(form){
    $("#loader").fadeIn();

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
});


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

function editarLugar(idLugar,data)
{ 
 
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
      modal += '<form class="form-signin" id="update-lugar">';
      modal += '<div class="form-label-group">';
      modal += '<input type="text" id="lugar-update" name="lugar" class="form-control valid" value="'+data+'"/>';
      modal += '<input type="hidden" id="idLugar" name="idLugar" value="'+idLugar+'"/>';
      modal += '</div>';
      modal += '</form>';
      modal += '</div>';
      modal += '<div class="modal-footer">';
      modal += '<button type="button" class="btn btn-primary" onclick="update();">Actualizar</button>';
      modal += '<button type="button" class="btn btn-secondary close-modal" onclick="closeModal();" id="close-modal" data-dismiss="modal">Cancelar</button>';
      modal += '</div>';
      modal += '</div>';
      modal += '</div>';

  $("#modal-msj").fadeIn().html(modal);

}

function update()
{

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let url = path+'ajax/editarLugar.php';
  let dataString = $("#update-lugar").serialize() + '&email='+email;

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
        let alert = '<div class="alert alert-success" role="alert">Se ha actualizado el lugar!</div>';
        $("#alert-msj").show().html(alert);
        setTimeout(function(){
          $("#alert-msj").fadeOut();
          closeModal();
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