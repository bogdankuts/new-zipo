$('.js_trigger_closet_form').on('click', function(e) {
	e.preventDefault();
	if (confirm('Подтвердить удаление')) {
		$(this).closest($('form')).submit();
	} else {
		return false;
	}

});