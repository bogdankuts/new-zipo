/**
 * Created by BogdanKootz on 16.10.16.
 */
$('.delete_order').on('click', function() {
	console.log('delete');
	$.post('/admin/delete-order/'+$(this).data('id'))
		.done(
			location.reload()
		);
});