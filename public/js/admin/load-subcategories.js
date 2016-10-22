$category = $('#categoryActive').val();
if($category === '') {
	$category = 'Механическое_en';
}
$subcategory = $('#subcategoryActive').text();

//	choose active category
$(document).ready(function() {
	$('#CategorySelect').val($category);
	getSubcats($category, $subcategory);
});

$('#CategorySelect').on('change', function() {
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
			$subcats = $('#SubcategoriesSelect');
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