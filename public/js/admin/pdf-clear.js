/**
 * Created by BogdanKootz on 19.10.16.
 */
$('.clear_item_button').on('click', function(e) {
	e.preventDefault();
	var $form = $('.update_item_form');
	$form.find('input[name="good"]').val("");
	$form.find('select[name="category"]').val("Механическое_en");
	getSubcats("Механическое_en", '');
	$form.find('.title_div').removeClass('is-upgraded');
	$form.find('.mdl-textfield').removeClass('is-dirty');
	$form.find('#file_div').addClass('is-dirty');

});