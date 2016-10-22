<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=1200'>

		@yield('meta')

		<link rel="shortcut icon" href="{{ asset('img/markup/favicon.ico') }}">

		{{--DEVELOPMENT MODE ONLY--}}
		{{--{{ Html::style('css/bootstrap.min.css') }}--}}
		{{--{{ Html::style('css/font-awesome.min.css') }}--}}

		{{--PRODUCTION MODE ONLY--}}
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		{{ Html::style('css/user-interface/style.css') }}

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- font awesome -->
		<script src="https://use.fontawesome.com/148eee4d95.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		{{ Html::script('js/vendor/betterContactForm.js') }}

		@yield('css')

		@include('user-interface.partials.analytics')
	</head>
	<body>

		@yield('header')
		@yield('flash-messages')
		@include('user-interface.partials.entrance-modal')

		<div class="container_main">
			@yield('left_sidebar')
			@yield('right_sidebar')
			@yield('body')
		</div>

		@yield('footer')

		<div id="scrollup">
			<i class="fa fa-arrow-circle-up to_top_button fa-4x"></i>
		</div>

		@include('user-interface.partials.general-js')

		{{Html::script('js/user-interface/catalog.js')}}
		{{Html::script('js/user-interface/subcategories.js')}}
		{{Html::script('js/user-interface/scrollToTop.js')}}
		{{Html::script('js/user-interface/sidebars.js')}}
		{{Html::script('js/user-interface/cart.js')}}

		@yield('page-js')

		@if($modal)
			<script>
				$(window).on('load', function() {
					$('#enterModal').modal('show');
				});
			</script>
		@endif

	</body>
</html>