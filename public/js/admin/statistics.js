/**
 * Created by BogdanKootz on 15.10.16.
 */
$(document).ready(function(){
	$('.articles_more_statistic_block').slideUp();
	$('.items_more_statistic_block').slideUp();
});
$('#items_more_statistic').on('click', function() {
	$('.articles_more_statistic_block').slideUp();
	$('.items_more_statistic_block').slideDown();
});
$('#articles_more_statistic').on('click', function() {
	$('.items_more_statistic_block').slideUp();
	$('.articles_more_statistic_block').slideDown();
});
$('.list_make_hit').on('change', function() {
	$.post(
		'admin/toggle_item_hit/'+$(this).data('id'));
});