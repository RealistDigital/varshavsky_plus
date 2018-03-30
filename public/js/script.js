$(document).ready(function () {

	// SHOW/HIDE SUBMENU
	$('.menu_item').click(function(){
		var element = $(this).find('.sub_menu')
		if (element.hasClass('show_menu')){
			element.removeClass('show_menu');
		} else {
			$('.sub_menu').removeClass('show_menu');
			element.addClass('show_menu');
		}	
	});

});