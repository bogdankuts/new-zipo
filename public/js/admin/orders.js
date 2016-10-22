/**
 * Created by BogdanKootz on 30.05.16.
 */
$aboutClient = $('.about_client');
$client_less = $('.client_less');

$aboutClient.on('click', function (e) {
	e.preventDefault();
	$target = $(this).data('target');
	$block = $('#'+$target);

	$('.one_order').removeClass('active_client');
	$client_less.hide();
	$aboutClient.show();
	$block.addClass('active_client');
	$(this).hide();
	$('#less_'+$target).show();
});


$client_less.on('click', function (e) {
	e.preventDefault();
	$target = $(this).data('target');

	$('.one_order').removeClass('active_client');
	$(this).hide();
	$('#more_'+$target).show();
});

$state = $('.state');

$state.on('change', function() {
	$target = $(this).data('target');
	$newState = $(this).val();

	$.ajax({
		url: '/admin/change-order-state',
		type: 'POST',
		dataType: "json",
		data: {
			'order_id' 	: $target,
			'state'	: $newState
		},
		success: function(data) {
			location.reload();
		},
		error: function(data, error, error_details){
			console.log("err:",error, error_details);
			console.log(data);
			console.log(JSON.stringify(data.responseText, '\\', ''));
		}
	});

});

$('.save_state').on('click', function(e) {
	e.preventDefault();

	$target = $(this).data('target');
	$form = $(this).closest('form');
	$newTitle = $form.find('#state_title').val();

	if (confirm('Подтвердить изменение')) {
		$.ajax({
			url: '/admin/ajax-update-state',
			type: 'POST',
			dataType: "json",
			data: {
				'state_id': $target,
				'new_state': $newTitle
			},
			error: function (data, error, error_details) {
				console.log("err:", error, error_details);
				console.log(data);
				console.log(JSON.stringify(data.responseText, '\\', ''));
			}
		});
	} else {
		return false;
	}
});

$('.delete_state').on('click', function(e) {
	e.preventDefault();

	$target = $(this).data('target');

	if (confirm('Подтвердить удаление')) {
		$.ajax({
			url: '/admin/ajax-delete-state',
			type: 'POST',
			dataType: "json",
			data: {
				'state_id': $target,
			},
			error: function (data, error, error_details) {
				console.log("err:", error, error_details);
				console.log(data);
				console.log(JSON.stringify(data.responseText, '\\', ''));
			}
		});
		$('#'+$target+'_state').hide();
	} else {
		return false;
	}
});

$('.create_state').on('click', function(e) {
	e.preventDefault();

	if (confirm('Подтвердить добавление')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});
