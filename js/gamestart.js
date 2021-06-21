/*
 * remixed by Marcexl 
 * version 18062021
 */

function gameStart()
{
  $("section").fadeOut();
  $("#alert-msj").fadeOut();
  setTimeout(function(){
    showMainMenu();
  },500);
}

/*
 * funcion que trae 
 * - nivel
 * - puntaje
 * - avatar
 */
function showMainMenu()
{ 
  $("#main-menu").fadeIn();
  $("#header-menu").fadeIn();
  $("#footer-menu").fadeOut();
  //$(".pmd-floating-action").fadeIn(); 

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  

  let url = path+'ajax/getDatosCuenta.php';
  let dataString = '&email='+email;
  
  $.ajax({
    type: 'GET',
    url: url,
    data:dataString,
    headers: {'Authorization': 'Bearer '+token},
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
        let avatar = data['avatar'];
        $("#main-avatar").attr("src","img/avatar/"+avatar);     
      }
    }
  }); 
}


function whereIs()
{ 
  $("section").fadeOut();
  //$(".pmd-floating-action").fadeIn(); 

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  

  let url = path+'ajax/whereIsFelipe.php';
  let dataString = '&email='+email;
  
  $.ajax({
    type: 'GET',
    url: url,
    data:dataString,
    headers: {'Authorization': 'Bearer '+token},
    error: function (res){
      console.log(res);
    },
    beforeSend: function(){
    },
    success: function(res){
      $("#footer-menu").fadeIn();
      let data = JSON.parse(res);
      if(data['success'] == true)
      {
        let avatar = data['avatar'];
        let stage  = data['stage'];
        $("#felipe").attr("src","img/whereis/"+avatar); 
        $("#stage").html(stage); 
        setTimeout(function(){
          $("#whereis").fadeIn();
        },500);
      }
    }
  }); 
}
