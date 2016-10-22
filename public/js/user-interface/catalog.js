/**
 * Created by BogdanKootz on 07.10.16.
 */
$subcategories = $('.subcategory_block');
$categories = $('.catalog_category');
$categories.on('click', function() {
	var clicked_category_data = $(this).data('category');
	var $clicked_subcategory = $subcategories.filter(function(index) {
		return $(this).data('category') === clicked_category_data;
	});

	// CHANGE BACKGROUND
	var clicked_category_data = $(this).data('category');
	if (clicked_category_data == 'Механическое_en'|| clicked_category_data=='Механическое_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_mechan.png)',
			'background-repeat': 'no-repeat',
			'background-position' : 'bottom left'
		});
	} else if(clicked_category_data == 'Тепловое_en' || clicked_category_data == 'Тепловое_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_teplovoe.png)',
			'background-repeat': 'no-repeat',
			'background-position' : 'bottom left'
		});
	}else if(clicked_category_data == 'Холодильное_en' || clicked_category_data == 'Холодильное_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_holod.png)',
			'background-repeat': 'no-repeat',
			'background-position' : 'bottom left'
		});
	}else if(clicked_category_data == 'Моечное_en' || clicked_category_data == 'Моечное_ru') {
		$(".main_content").css({'background-image' : 'url(../img/markup/background_posuda.png)',
			'background-repeat': 'no-repeat',
			'background-position' : 'bottom left'
		});
	}
});

