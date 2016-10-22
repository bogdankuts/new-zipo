if (getCookie('sort') != null && getCookie('order') != null) {
	var sort = getCookie('sort');
	var order = getCookie('order');
	var $options = $('#items_sort option');
	$options.each(function(index) {
		if ($(this).val() == sort && $(this).data('order') == order) {
			$(this).attr("selected", "selected");
		}
	});
} else {
	var $option = $('#items_sort').find('option:selected');
	var sort = $option.val();
	var order = $option.data('order');
	setCookie('sort', sort, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
	setCookie('order', order, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
}

$('#items_sort').on('change', function() {
	var $option = $(this).find('option:selected');
	var sort = $option.val();
	var order = $option.data('order');
	setCookie('sort', sort, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
	setCookie('order', order, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
	var link = $option.data('link');
	window.location = link;
});