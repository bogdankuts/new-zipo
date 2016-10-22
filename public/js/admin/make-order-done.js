/**
 * Created by BogdanKootz on 16.10.16.
 */
$('.mark_order_done').on('click', function() {
	console.log('bla');
	$.post('/admin/mark-order-as-done/'+$(this).data('id'))
		.done(
			location.reload()
		);
});