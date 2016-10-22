/**
 * Created by BogdanKootz on 18.10.16.
 */
$('.producer_clean').on('click', function(e) {
	e.preventDefault();
	var $form = $('.update_producer_form');
	$form.find('input[name="producer"]').val("");
});