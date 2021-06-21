/*
 * remixed by Marcexl 
 * version 18052020
 */

function avatargallery()
{
  $("section").fadeOut();
  setTimeout(function(){
    getAvatar();
  },500);
}

function getAvatar()
{ 
  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email; 

  let url = path+'ajax/getAvatar.php';
  let dataString = "&email="+email;

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
      $("#avatargallery").fadeIn();
      $("#avatargallery-result").html(res);
    }
  });
}

function selectAvatar(id)
{
  $(".img-thumbnail").removeClass("active");
  $("#avatar-"+id).addClass("active");

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = "&email="+email+"&idAvatar="+id;
  let url = path+'ajax/chooseAvatar.php';

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
      $("#avatar-button").fadeOut();
    },
    success: function(res){
      let data = JSON.parse(res);
      $("#loader").fadeOut(); 
      
      if(data['success'] == true)
      {
        $("#avatar-button").fadeIn();

        $("html, body").delay(1000).animate({ scrollTop: $('#avatar-button').offset().top }, 500);

      }
      else
      {
        let msj = data['msj'];
        let alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
        $("#alert-msj").show().html(alert);
        return false;
      }
    }
  });
}