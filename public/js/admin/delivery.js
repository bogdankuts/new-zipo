/**
 * Created by BogdanKootz on 06.09.16.
 */
$('.save_delivery').on('click', function(e) {
	e.preventDefault();

	if (confirm('Подтвердить изменение')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});

$('.delete_delivery').on('click', function(e) {
	e.preventDefault();

	if (confirm('Подтвердить удаление')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});

$('.create_delivery').on('click', function(e) {
	e.preventDefault();

	if (confirm('Подтвердить добавление')) {
		$form = $(this).closest('form');
		$form.trigger('submit');
	} else {
		return false;
	}
});