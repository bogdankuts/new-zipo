/**
 * Created by BogdanKootz on 16.10.16.
 */
//DISABLE BUTTONS AT FOOTER
function formMessage($num, $str1, $str2, $str3) {
	$val = $num % 100;

	if ($val > 10 && $val < 20) {
		return $num+' '+$str3;
	} else {
		$val = $num % 10;
		if ($val == 1) {
			return $num+' '+$str1;
		} else if ($val > 1 && $val < 5) {
			return $num+' '+$str2;
		} else {
			return $num+' '+$str3;
		}
	}
}
var message = formMessage(0, 'элемент', 'элемента', 'элементов');

$(".selected_quantity").text('Выбрано: '+message);
$(".admin_footer_btn").attr('disabled', '');
//$(".admin_items_footer .admin_footer_btn").attr('disabled', ''); TODO::uncomment!

$( ".admin_main_content_items input[type=checkbox]" ).on("click", function() {
	countChecked();
});

//SELECT ALL
$('.select_all_btn').on('click', function(e){
	e.preventDefault();
	$('.admin_main_content_items input[type=checkbox]').prop('checked', true);
	countChecked();
	formIdsArray();
	$('label.item_selected_checkbox').addClass('is-checked');
	$(this).hide();
	$('.deselect_all_btn').show();
});
$('.deselect_all_btn').on('click', function(e){
	e.preventDefault();
	$('.admin_main_content_items input[type=checkbox]').prop('checked', false);
	countChecked();
	formIdsArray();
	$('label.item_selected_checkbox').removeClass('is-checked');
	$(this).hide();
	$('.select_all_btn').show();
});

function countChecked() {
	var n = $(".admin_main_content_items  input[type=checkbox]:checked").length;

	enableFooter(n);
	var message = formMessage(n, 'элемент', 'элемента', 'элементов');
	$(".selected_quantity").text('Выбрано: '+message);
}

function enableFooter(n) {
	if (n == 0) {
		$(".admin_footer_btn").attr('disabled', '');
	} else {
		$(".admin_footer_btn").removeAttr('disabled');
	}
}


var contains = function(needle) {
	// Per spec, the way to identify NaN is that it is not equal to itself
	var findNaN = needle !== needle;
	var indexOf;

	if(!findNaN && typeof Array.prototype.indexOf === 'function') {
		indexOf = Array.prototype.indexOf;
	} else {
		indexOf = function(needle) {
			var i = -1, index = -1;

			for(i = 0; i < this.length; i++) {
				var item = this[i];

				if((findNaN && item !== item) || item === needle) {
					index = i;
					break;
				}
			}

			return index;
		};
	}

	return indexOf.call(this, needle) > -1;
};

//GET CHECKED IDS
IDS = [];
$(".admin_main_content_items input[type=checkbox]").on("change", function(){
	//formIdsArray();
	var checkedID = $(this).data("id");
	if(contains.call(IDS, checkedID)) {
		IDS = $.grep(IDS, function(value) {
			return value != checkedID;
		})
	} else {
		IDS.push(checkedID);
	}
});

function formIdsArray() {
	$.each($(".admin_main_content_items  input[type=checkbox]"), function() {
		var checkedID = $(this).data("id");
		console.log(checkedID);
		if(contains.call(IDS, checkedID)) {
			IDS = $.grep(IDS, function(value) {
				return value != checkedID;
			})
		} else {
			IDS.push(checkedID);
		}
		console.log(IDS);
	})
}

//CHANGE HIT SPECIAL PROCUREMENT
$('.ajax_change_state').on('click', function(e) {
	e.preventDefault();
	var url = $(this).data('url');
	console.log(url);{}

	$.ajax({
		url: url,
		type: 'POST',
		dataType: "json",
		data: {
			'ids' : IDS,
		},
		success: function(data) {
			location.reload();
		},
		error: function(data, error, error_details){
			console.log("err: ",error, error_details);
			console.log(data);
			console.log(JSON.stringify(data.responseText, '\\', ''));
		}
	});
});

//DELETE GROUP BUTTON
$('.delete_group_button').on('click', function(e) {
	e.preventDefault();
	var url = $(this).data('url');

	function ajax_delete_group() {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: "json",
			data: {
				'ids' : IDS,
			},
			success: function(data) {
				location.reload();
			},
			error: function(data, error, error_details){
				console.log("err: ",error, error_details);
				console.log(data);
				console.log(JSON.stringify(data.responseText, '\\', ''));
			}
		});
	}

	if (confirm('Подтвердить удаление')) {
		ajax_delete_group();
	} else {
		return false;
	}
});

//CHANGE SUBCATEGORY BUTTON
$('.change_subcat_button').on('click', function(e) {
	e.preventDefault();
	var subcat_id = $('.admin_select_title_text').val();
	var url = $(this).data('url');
	if (subcat_id < 1) {
		alert('Вы должны создать подкатегорию!');
		return false;
	} else {
		$.ajax({
			url: url,
			type: 'POST',
			dataType: "json",
			data: {
				'ids' 		: IDS,
				'subcat_id'	: subcat_id
			},
			success: function(data) {
				location.reload();
			},
			error: function(data, error, error_details){
				console.log("err:",error, error_details);
				console.log(data);
				console.log(JSON.stringify(data.responseText, '\\', ''));
			}
		});
	}
});

$category = $('#categoryActive').text();
$subcategory = $('#subcategoryActive').text();

//	choose active category
$(document).ready(function() {
	$('#popupCategorySelect').val($category);
	getSubcats($category, $subcategory);
});

$('#popupCategorySelect').on('change', function() {
	$categorySelected =  $(this).val();
	getSubcats($categorySelected, '');
});


function getSubcats($category, $subcategory) {
	$.ajax({
		url: location.origin+'/admin/ajax-get-subcategories',
		type: 'POST',
		dataType: "json",
		data: {
			'category' : $category
		},
		success: function(data) {
			$subcats = $('#popupSubcategoriesSelect');
			// CLEAR OLD SUBCATS
			$subcats.html('');

			for (var i = 0; i < data.length; i++) {
				var subcat = data[i]['subcat'];
				var subcat_id = data[i]['subcat_id'];

				var $option = $("<option value='" + subcat_id + "'>" + subcat + "</option>");
				$subcats.append($option);
			}

			if ($subcategory !== '') {
				$subcats.val($subcategory);
			}
		},
		error: function(data, error, error_details){
			console.log("err:",error, error_details);
			console.log(data);
		}
	});
}


//CHANGE PDF BUTTON
$('.change_item_pdf').on('click', function(e) {
	var pdf_id = $('.admin_select_pdf').val();
	var url = $(this).data('url');
	$.ajax({
		url: url,
		type: 'POST',
		dataType: "json",
		data: {
			'ids' 		: IDS,
			'pdf_id'	: pdf_id
		},
		success: function(data) {
			location.reload();
		},
		error: function(data, error, error_details){
			console.log("err:",error, error_details);
			console.log(data);
			console.log(JSON.stringify(data.responseText, '\\', ''));
		}
	});
});

//CHANGE PROCUREMENT BUTTON
$('.change_item_procurement').on('click', function(e) {
	var supply_id = $('.admin_select_procurement').val();
	var url = $('.admin_select_procurement').data('url');
	$.ajax({
		url: url,
		type: 'POST',
		dataType: "json",
		data: {
			'ids' 		: IDS,
			'supply_id'	: supply_id
		},
		success: function(data) {
			location.reload();
		},
		error: function(data, error, error_details){
			console.log("err:",error, error_details);
			console.log(data);
			console.log(JSON.stringify(data.responseText, '\\', ''));
		}
	});
});