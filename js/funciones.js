/*
 * remixed by Marcexl 
 * version 18062021
 */


/* algunas reglas de texto */
$('#username').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z0-9]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#userfname').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});


$('#userlname').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#useredad').on('input', function() {
  var c = this.selectionStart,
      r = /[^0-9]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#cuenta-fname').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#cuenta-lname').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#cuenta-user').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#cuenta-edad').on('input', function() {
  var c = this.selectionStart,
      r = /[^0-9]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});


$('#lugar').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});

$('#lugar-update').on('input', function() {
  var c = this.selectionStart,
      r = /[^a-z \ \ñ \u00E0-\u00FC]/gi,
      v = $(this).val();

  if(r.test(v))
  {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});



function checkerror(code){
  let error = code;
  if(error == 403)
  {
    $("section").fadeOut();
    let msj = 'No es un usuario autorizado';
    let alert = '<div class="alert alert-warning" role="alert">'+msj+'</div>';
    $("#alert-msj").show().html(alert);
    localStorage.removeItem("people");
    setTimeout(function(){
      location.reload();
    },1500);
    return false;
  }
}; 

function closeModal(){
  $("#modal-msj").fadeOut();
}

function getNotify(){
  $("section").fadeOut();
  setTimeout(function(){
    $("#notificaciones").fadeIn();
  },500);
}

$(document).ready(function(){
  $('.ir-arriba').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });
 
  $(window).scroll(function(){
    if( $(this).scrollTop() > 300 ){
      $('.ir-arriba').slideDown(300);
    } else {
      $('.ir-arriba').slideUp(300);
    }
  }); 
});

