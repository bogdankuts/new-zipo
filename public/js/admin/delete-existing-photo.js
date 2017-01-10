/**
 * Created by BogdanKootz on 24.10.16.
 */
$('.js-delete-existing-photo').on('click', function() {
	console.log($(this));
	$photo = $(this).data('photo');
	console.log($photo);
	$id = $(this).data('id');
	console.log($id);
	$.post('/admin/item/multi-image-delete/' + $id + '/' + $photo);
	$('img').filter(function(){
		return $(this).data("title")   == $photo}).hide();
	$(this).hide();
});