<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=1200'>
		<meta name='keywords' content='Оборудование для баров, кафе, ресторанов, комплексное оснащение баров, ксобровождение баров, техника для баров, кафе ресторанов, техника для общепита, открытие ресторана Россия, техника для точек питания, запчасти для техники, запчасти для барного оборудования, запчасти для холодильного оборудования, запчасти для пекарского оборудования, запчасти для производственного оборудования, запчасти для кафе, холодильное оборудование, барное оборудование, пекарское оборудование, нейтральное оборудование, Санкт-Петербург, Россия'>
		<meta name='description' content='Комплексное оснащение баров, ресторанов,кафе, пищевых производств и магазинов.'>
		@yield('meta')
		<title>Зип Общепит - Комплексное оснащение баров, ресторанов, кафе, пищевых производств и магазинов</title>
		<link rel="shortcut icon" href="{{ asset('img/markup/favicon_admin.ico') }}">

		{{--MATERIAL DESIGN--}}
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.red-orange.min.css" />
		<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
		{{--	{{ Html::style('css/new_admin/material.min.css') }}--}}
		{{--	{{ Html::script('js/admin/material.min.js') }}--}}
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		{{--CUSTOM STYLES--}}
	{{--	{{ Html::style('css/style.css') }}--}}
		{{ Html::style('css/admin/style.css') }}
		{{ Html::style('chosen_v1.6.2/chosen.css') }}
	{{--	{{ Html::script('ckeditor/ckeditor.js') }}--}}
		@yield('css')
	</head>

	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			@yield('header')
			@yield('drawer')
			<main class="mdl-layout__content mdl-color--grey-100">
				<div class="mdl-grid page-content">
					@include('admin.partials.flash-messages')
					@yield('body')
				</div>
			</main>
		</div>

		@yield('modal-change-subcategory')
		@yield('modal-change-procurement')
		@yield('modal-add-to-pdf')
		@yield('modal-add-subcategory')
		@yield('modal-edit-subcategory')
		@yield('modal-add-state')

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		{{ Html::script('js/admin/search.js') }}
		{{ Html::script('js/admin/logout.js') }}
		<script>
			var TOKEN = "{{csrf_token()}}";
		</script>
		{{Html::script('js/admin/ajax-hack.js')}}

		{{--		{{ Html::script('js/new_admin.js') }}--}}
{{--		{{ Html::script('js/common.js') }}--}}
		{{--{{ Html::script('js/admin.js') }}--}}
		{{ Html::script('chosen_v1.6.2/chosen.jquery.min.js') }}
		@yield('page-js')
	</body>
</html>