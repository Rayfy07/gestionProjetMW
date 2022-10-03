$(document).ready(function() { 
    $(window).resize(function(){
       var width = $(window).width();
 
       if(width <= 991){
          $('.offcanvas').removeClass('show');
          $('#btn-offcanvas').show();
          $('.btn-close').show();
          $('#img').show();
       }
       else if (width > 992){
          $('.offcanvas').addClass('show');
          $('#btn-offcanvas').hide();
          $('.btn-close').hide();
          $('#img').hide();
       }
    })
 
 .resize();
 
 });