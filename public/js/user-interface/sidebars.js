/**
 * Created by BogdanKootz on 07.10.16.
 */
$(window).on('load', function() {
	var $window = $(window);
	var $left_sidebar = $('.left_sidebar');
	var $right_sidebar = $('.right_sidebar');

	var offset_top = $left_sidebar.offset().top;
	var $body = $('body');
	var page_height = $body.height();
	var sidebar_height = $left_sidebar.height();

	var max = page_height - sidebar_height - 111;
	$window.on('scroll', function() {
		var scroll = $window.scrollTop();
		// was max-342 +30
		if (scroll > offset_top && scroll < max-42) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : scroll-offset_top + 10
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : scroll-offset_top + 10
			});
		} else if (scroll < offset_top) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : '0px'
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : '0px'
			});
		} else if (scroll > max-342) {
			$left_sidebar.clearQueue().animate({
				'margin-top' : max-342+'px'
			});
			$right_sidebar.clearQueue().animate({
				'margin-top' : max-342+'px'
			});
		}
	});
});