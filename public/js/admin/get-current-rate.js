$('#js_get_current_rate').on('click', function (e) {
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: '/admin/get-eur-rate/',
		// data: data,
		success: function (data) {
			$('#rate').val(data);
		}
	});
});