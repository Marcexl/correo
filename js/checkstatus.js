/*
 * remixed by Marcexl 
 * version 18062021
 */
function checkStatus()
{
  checkActivate();
}

function checkActivate()
{
  $("section").fadeOut();
  $("#loader").fadeIn(); 
  $("#loader-msj").html("Chequeando activación...");

	let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = "&email="+email;
  let url = path+"ajax/checkActivate.php";
  $.ajax({  
    method:"POST",  
    url:url,
    data:dataString,
    headers: {'Authorization': 'Bearer '+token},
    error: function (res){
      console.log(res);
    },
    beforeSend: function(res){     
    }, 
    success:function(res)
    {
      let data = JSON.parse(res);
      $("#loader").fadeOut();  
      
      checkerror(data['code']);    
    	
      if(data['success'] == true)
      {
        checkAvatar();
      }
      else
      {
        setTimeout(function(){
          $("#avatargallery").fadeIn();
        },500);
      }  
    }  
  });
}

function checkAvatar()
{
  $("section").fadeOut();

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = "&email="+email;
  let url = path+"ajax/checkAvatar.php";
  $("#loader").fadeIn(); 
  $("#loader-msj").html("Chequeando avatar...");

  $.ajax({  
    method:"POST",  
    url:url,
    data:dataString,
    headers: {'Authorization': 'Bearer '+token},   
    error: function (res){
      console.log(res);
    },
    beforeSend: function(res){
     
    }, 
    success:function(res)
    {
      let data = JSON.parse(res);
      $("#loader").fadeOut(); 
      
      checkerror(data['code']);    
      
    	if(data['success'] == true)
      {
        checkDatosPersonales();
      }
      else
      {
        setTimeout(function(){
          avatargallery();
        },500);
      }      
    }  
  });
}

function checkDatosPersonales()
{
  $("section").fadeOut();
  $("#loader").fadeIn(); 
  $("#loader-msj").html("Chequeando datos personales...");

  let usrInfo = JSON.parse(localStorage.getItem("people"));
  let token   = usrInfo.token;  
  let email   = usrInfo.email;  
  let dataString = "&email="+email;
  let url = path+"ajax/checkDatosPersonales.php";

  $.ajax({  
    method:"POST",  
    url:url,
    data:dataString,   
    headers: {'Authorization': 'Bearer '+token},   
    error: function (res){
      console.log(res);
    },
    beforeSend: function(res){    
    }, 
    success:function(res)
    {
      $("#loader-msj").html("");
      let data = JSON.parse(res);
      $("#loader").fadeOut(); 
      
      checkerror(data['code']);    
      
      if(data['success'] == true)
      {
        checkTutorial();
      }
      else
      {
        setTimeout(function(){
          $("#datospersonales").fadeIn();
          getProvincias();
        },500);
      }       
    }  
  });
}


function checkTutorial()
{

	/*if(localStorage.getItem("tutorial"))
	{
		return true;
	}
	else
	{
		return false;
	}*/
  gameStart();

}
