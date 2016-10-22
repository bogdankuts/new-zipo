/**
 * Created by BogdanKootz on 07.10.16.
 */
/*------------------------------------------------
 | SCROLL TO TOP BUTTON
 ------------------------------------------------*/
$('#scrollup').mouseover(function(){
	$(this).animate({opacity: 0.65},100);
}).mouseout( function(){
	$(this).animate({opacity: 1},100);
}).click(function(){
	window.scroll(0,0);
	return false;
});

$(window).on('load', function() {
	var $window = $(window);
	var $left_sidebar = $('.left_sidebar');
	var $right_sidebar = $('.right_sidebar');

	var offset_top = $left_sidebar.offset().top;
	var $body = $('body');
	var page_height = $body.height();
	var sidebar_height = $left_sidebar.height();
	var max = page_height - sidebar_height - 111;

	$(window).scroll(function(){
		var scroll = $window.scrollTop();

		if (scroll > max) {
			$('#scrollup').css('bottom', '140px');
		} else {
			$('#scrollup').css('bottom', '10px');
		}

		if ($(document).scrollTop() > 0) {
			$('#scrollup').fadeIn('fast');
		} else {
			$('#scrollup').fadeOut('fast');
		}
	});
});