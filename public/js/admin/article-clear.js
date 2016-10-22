$('.article_clean').on('click', function(e) {
	e.preventDefault();
	var $form = $('.article_update_form');
	$form.find('input[name="title"]').val("");
	$form.find('input[name="meta_title"]').val("");
	$form.find('input[name="meta_description"]').val("");
	$form.find('input[name="weight"]').val("");
	CKEDITOR.instances.ckeditor.setData('');
});
