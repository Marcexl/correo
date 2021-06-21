/*
 * remixed by Marcexl 
 * version 18062021
 */
$(document).ready(function(){
  
  /* para el menu con iconos*/
  var float = 0;
  var loto  = 0;
  var cnt   = 1;

  $("#floating-action-btn").click(function(){

    if(float == 0)
    {
      changeIcon(1);

      $(".menu-floating").addClass("menu-floating-show");
      $(".menu-floating a").each(function () {
        $(this).attr('id', function (index) {
             $(this).attr('id', 'grow-' + (cnt));
        });
        cnt++;
      });

      float = 1;  
      cnt = 1;
      $('.menu-floating').on('click', 'a', function() 
      {
        $(".menu-floating").removeClass("menu-floating-show");
        float = 0;
        changeIcon(2);
      });

    } 
    else 
    {
      changeIcon(2);
      $(".menu-floating").removeClass("menu-floating-show");
      cnt = 1;
      float = 0;
    }
  })

  $(".menu-icons-item").click(function(){
    $(".menu-icons-item").removeClass("menu-icon-active");
    $(this).addClass("menu-icon-active");
  });

  /* menu web*/
  $("#icon-menu").click(function(){

    if(loto == 0)
    {
      $("#footer-menu").css("margin-right","0px");
      
      loto = 1;  

      $('#footer-menu ul').on('click', 'li', function() 
      {
        $("#footer-menu").css("margin-right","-200px");
        
        loto = 0;
      });

      var container3 = $("#footer-menu");

      $(document).mouseup(function(e){

        if (!container3.is(e.target) && container3.has(e.target).length === 0) 
        {
          $("#footer-menu").css("margin-right","-200px");

          loto = 0;
        }
      });
    
    } 
    else 
    {
      $("#footer-menu").css("margin-right","-200px");

      loto = 0;
    }
  })

})

function changeIcon(step)
{
  if(step == 1)
  {
    $("#floating-master-icon").css("transform","rotate(45deg)");
  }

  if(step == 2)
  {
    $("#floating-master-icon").css("transform","rotate(0deg)");
  }
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
