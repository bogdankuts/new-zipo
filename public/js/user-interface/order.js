/**
 * Created by BogdanKootz on 12.10.16.
 */
//$('.pay_radio').click(function() {
//	if($('#physic').is(':checked')) {
//		$('.requisites').slideUp();
//		if ($('#delivery').val() !== 'self') {
//			$('.address').slideDown();
//		}
//		$('.payment_method_jura').slideUp();
//		$('.payment_method_physic').slideDown();
//
//		//if($('#physic_pay_card').is(':checked')) {
//		//	$(".js_to_discount").val(function(index, value ) {
//		//		return value*0.95;
//		//	});
//		//
//		//}
//
//	} else {
//		$('.address').slideUp();
//		$('.requisites').slideDown();
//
//		$('.payment_method_jura').slideDown();
//		$('.payment_method_physic').slideUp();
//	}
//});
$(document).ready(function() {
	$value = $('#delivery').val();
//	$deliveryPrice = $('#full_summ');
	$onlyDelivery = $('#delivery_only_summ');
	$totalAmount = $('#totalAmount');
	$orderSum = parseInt($totalAmount.text());

	if ($value !== 'self') {
		$('.address').slideDown();
	} else {
		$('.address').slideUp();
		$onlyDelivery.text('0 руб.');
		//$deliveryPrice.text($orderSum);
	}
	if ($value === 'Other') {
		$('.delivery_other').slideDown();
	} else {
		$('.delivery_other').slideUp();
	}
});
$('.js-post-order').on('click', function () {
	$(this).closest('form').submit();
	$(this).prop('disabled', true);
});
$('#delivery').on('change', function() {
	$value = $(this).val();
	//$deliveryPrice = $('#full_summ');
	$totalAmount = $('#totalAmount');
	$orderSum = parseInt($totalAmount.text());
	$onlyDelivery = $('#delivery_only_summ');
	if ($value !== 'self') {
		$('.address').slideDown();
	} else {
		$('.address').slideUp();
	}
	if ($value === 'Other') {
		$('.delivery_other').slideDown();
	} else {
		$('.delivery_other').slideUp();
	}

	if ($value != 'self' && $value != 'PEK' && $value != 'TK_business_lines' && $value != 'RATEK' && $value != 'St.Petersburg_delivery') {
		$onlyDelivery.text('Стоимость доставки пожалуйста уточните у менеджера.');
		//$deliveryPrice.text('Окончательную стоимость с доставкой уточнит менеджер.');
		$('.js_currency').text('');
	} else {
		$('.js_currency').text(' руб.');

	}

	if ($value == 'self') {
		$onlyDelivery.text('0 руб.');
		//$deliveryPrice.text($orderSum);
	}
	if ($value == 'PEK') {
		$onlyDelivery.text('200 руб.');
		//if ($orderSum < 20000) {
			//$deliveryPrice.text($orderSum + 200);
		//} else {
			//$deliveryPrice.text($orderSum);
		//}
	}

	if ($value == 'TK_business_lines' || $value == 'RATEK') {
		$onlyDelivery.text('150 руб.');
		//if ($orderSum < 20000) {
			//$deliveryPrice.text($orderSum + 150);
		//} else {
			//$deliveryPrice.text($orderSum);
		//}
	}

	if ($value == 'St.Petersburg_delivery') {
		$onlyDelivery.text('350 руб.');
		//if ($orderSum < 20000) {
		//	$deliveryPrice.text($orderSum + 350);
		//} else {
		//	$deliveryPrice.text($orderSum);
		//}
	}
});
