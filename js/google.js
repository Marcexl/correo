/*
 * remixed by Marcexl 
 * version 22122020
 * for login with google oauth
 */
/*
(function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();

function login() 
{
  var myParams = {
    'clientid' : '706842631309-bnj8q7e2ofbcu4tbnrq0vmctkt67vrf6.apps.googleusercontent.com', //You need to set client id
    'cookiepolicy' : 'single_host_origin',
    'callback' : 'onSignIn', //callback function
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
  };
  gapi.auth.signIn(myParams);
}

function onSignIn(callback) {
  console.log(callback);
}*/

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.disconnect();//kill auto login

  var nombre  = profile.getName();
  var fname   = profile.getGivenName();
  var lname   = profile.getFamilyName();
  var avatar  = profile.getImageUrl();
  var email   = profile.getEmail();
  

  var dataString = "&email="+email+"&nombre="+nombre+"&lname="+lname+"&fname="+fname+"&avatar="+avatar;
  $("#loader").fadeIn();

  $.ajax({  
    method:"POST",  
    url:"ajax/googleSignIn.php",
    data:dataString,   
    success:function(res){
      var data = JSON.parse(res);
      if(data['success'] == true)
      {
        $("#loader").fadeOut();
        
        if(data['code'] == 1)
        {
          var msj = data['msj'];
          var alert = '<div class="alert alert-danger" role="alert">'+msj+'</div>';
          $("#alert-msj").show().html(alert);
          reloadForm();
          return false;
        }

        if(data['code'] == 2)
        {
          var msj   = data['msj'];
          var token = data['token'];
          var alert = '<div class="alert alert-success" role="alert">Te logeaste correctamente!</div>';
          $("#alert-msj").show().html(alert);
          var usrJson = {token:''+token+'',email:''+email+''};
          localStorage.setItem("people",JSON.stringify(usrJson));
          checkStatus();
          return false;
        }

        /* 
         *genero un storage para el logueo 
         */

        var token = data['token'];
        var usrJson = {token:''+token+'',email:''+email+''};
        localStorage.setItem("people",JSON.stringify(usrJson));
        checkStatus();
      }  
    }  
  });   
}