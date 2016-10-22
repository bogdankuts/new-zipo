/**
 * Created by BogdanKootz on 15.10.16.
 */
function countNotifications() {
	var existing = $('.one_notification').filter(function() {
		return $(this).css('display') !== 'none';
	}).length;

	if(existing < 1) {
		$('.notifications').hide();
	}
}
$('.close_notification-admins').on('click', function() {
	$('#newAdmins').hide();
	countNotifications();

});
$('.close_notification-users').on('click', function() {
	$('#newUsers').hide();
	countNotifications();

});
$('.close_notification-clients').on('click', function() {
	$('#newClients').hide();
	countNotifications();

});
$('.close_notification-articles').on('click', function() {
	$('#newArticles').hide();
	countNotifications();

});
$('.close_notification-discount').on('click', function() {
	$('#newDiscount').hide();
	countNotifications();

});
$('.close_notification-orders').on('click', function() {
	$('#newOrders').hide();
	countNotifications();

});
