/**
 * Created by BogdanKootz on 08.10.16.
 */
if (getCookie('pages_by') != null) {
	var pages_by = getCookie('pages_by');
	var $options = $('#pages_by option');
	$options.each(function(index) {
		if ($(this).val() == pages_by) {
			$(this).attr("selected", "selected");
		}
	});
} else {
	var $option = $('#pages_by').find('option:selected');
	var pages_by = $option.val();
	setCookie('pages_by', pages_by, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
}

$('#pages_by').on('change', function() {
	var $option = $(this).find('option:selected');
	var pages_by = $option.val();
	setCookie('pages_by', pages_by, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
	var link = $option.data('link');
	window.location = link;
});