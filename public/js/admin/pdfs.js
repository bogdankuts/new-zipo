$delete_btn = $('.delete_pdf');

$delete_btn.on('click', function (e) {
	e.preventDefault();
	$target = $(this).data('id');
	$url = $(this).data('url');

	if (confirm('Подтвердить удаление')) {
		console.log($target);
		$.ajax({
			url: $url,
			type: 'POST',
			dataType: "json",
			data: {
				'pdf_id': $target
			},
			success: function(data) {
				console.log(data);
			},
			error: function (data, error, error_details) {
				console.log("err:", error, error_details);
				console.log(data);
				console.log(JSON.stringify(data.responseText, '\\', ''));
			}
		});
		location.reload();
	} else {
		return false;
	}

});