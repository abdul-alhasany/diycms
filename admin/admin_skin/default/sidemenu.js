$(document).ready(function(){
	$(".action_buttons span").hide();
	$(".menu_block h1 .toggle_maxmize").hide();
	
 $(".menu_block h1").click(function () {
	  var num = $(this).parent().attr('id');
	  $("#"+num+" li").slideToggle("fast");
	  
	  $("#"+num+" h1 .toggle_maxmize").fadeToggle("fast");
	  $("#"+num+" h1 .toggle_minimize").fadeToggle("fast");
    });
	
	$(".buttons a").hover(function () {
	  var num = $(this).attr('id');
	  $("."+ num).fadeToggle();
    });
	
	
	
	var top = $('#side_menu').offset().top - parseFloat($('#side_menu').css('marginTop').replace(/auto/, 0));
  $(window).scroll(function (event) {
    // what the y position of the scroll is
    var y = $(this).scrollTop();
  
    // whether that's below the form
    if (y >= top) {
      // if so, ad the fixed class
      $('#side_menu').addClass('fixed');
    } else {
      // otherwise remove it
      $('#side_menu').removeClass('fixed');
    }
  });
});