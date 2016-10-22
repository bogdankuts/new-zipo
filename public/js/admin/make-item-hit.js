/**
 * Created by BogdanKootz on 16.10.16.
 */
$('.list_make_hit').on('change', function() {
	$.post(
		'admin/toggle-item-hit/'+$(this).data('id'));
});