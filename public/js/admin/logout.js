/**
 * Created by BogdanKootz on 15.10.16.
 */
$('.logout_link').on('click', function(evt) {
	evt.preventDefault();
	$form = $(this).closest('form');
	$form.trigger('submit');
});
