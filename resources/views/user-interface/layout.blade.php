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
		<link href="https://fonts.googleapis.com/css?family=Cormorant+Infant" rel="stylesheet">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		{{ Html::script('js/vendor/betterContactForm.js') }}

		@yield('css')

		@include('user-interface.partials.analytics')
	</head>
	<body>
		<div class="bg_banner" data-location="{{route('one_sale', ['new-year-sale'])}}">
			@if($snow == 1)
				<div id="snow"></div>
			@endif
		</div>
		
		@yield('header')
		@yield('flash-messages')
{{--	@include('user-interface.partials.entrance-modal')--}}
		<div class="container_main">
			<div class="sale-block">
				<a href="{{route('one_sale', ['new-year-sale'])}}" class="sale-title">Новогодняя распродажа</a>
			</div>
			@yield('left_sidebar')
			@yield('right_sidebar')
			@yield('body')
		</div>
		{{--</div>--}}
		
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
		
		<script>
			$('.bg_banner').on('click', function () {
				window.location = $(this).data("location");
			})
		</script>

		{{--@if($modal)--}}
			{{--<script>--}}
				{{--$(window).on('load', function() {--}}
					{{--$('#enterModal').modal('show');--}}
				{{--});--}}
			{{--</script>--}}
		{{--@endif--}}
		
		<div class="modal fade header_login" tabindex="-1" role="dialog" id="loginModal">
			<div class="modal-dialog" role="document">
				{{ Form::open(['url'=>'/user_login', 'method'=>'POST', 'class'=>'login_form input-group']) }}
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p class="login_form_title">Вход на сайт</p>
					</div>
					<div class="modal-body">
						<div class="form-group">
							{{ Form::label('email', 'E-mail', ['class'=>'login_form_label login_label_email']) }}
							{{ Form::email('email', null, ['class'=>'login_input', 'required', 'placeholder'=>"Ваш e-mail", 'class'=>'login_form_input form-control login_form_input_email']) }}
						</div>
						<div class="form-group">
							{{ Form::label('password', 'Пароль', ['class'=>'login_form_label login_label_password']) }}
							{{ Form::password('password', ['class'=>'login_input', 'required', 'placeholder'=>"Ваш пароль", 'class'=>'login_form_input form-control login_form_input_password']) }}
						</div>
					</div>
					<div class="modal-footer">
						{{ Form::submit('Войти', ['type' => 'button', 'class'=>'btn submit_field login_form_button']) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>

	</body>
</html>