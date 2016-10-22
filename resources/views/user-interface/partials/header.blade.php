@section('header')
	{{--<div class="snow_container">--}}
	{{--<div id="snow"> --}}
	<header>
		<hr class="header_top_hr">
		<div class="container_zipo">
			<div class="header_right">
				<div class="header_contacts">
					<p class="header_phone">тел. {{$p_phone->value}}</p><br>
					<p class="header_phone">тел. {{$s_phone->value}}</p>
				</div>
				<a href="/" class="logo_header">
					{{ Html::image("img/markup/logo.png", "ЗипОбщепит", ['class'=>'logo_header']) }}
				</a>
			</div>
			<div class="header_description">
				<h1 class="header_descriprion_heading">OOO "ЗИП Общепит"</h1><br>
				<p class="header_description_text">Ваш поставщик запасных частей,
					<br>для оборудования предприятий
					<br>общественного питания, пищеблоков,
					<br>баров, кафе, ресторанов, столовых
					<br>Срочный ремонт и техническое обслуживание. </p>
			</div>
			<div class="header_reg_adn_log">
				@if (Auth::user())
					<p class="user_email">Вы вошли как: </br> {{ Auth::user()->email }}</p>
					{{ Form::open(['url'=>'/user_logout', 'method'=>'POST', 'class'=>'logout_form']) }}
						{{ Form::submit('Выйти', ['class'=>'btn btn-default btn_exit']) }}
					{{ Form::close() }}
				@else
					<div class="btn-group btn-group-lg register" role="group" aria-label="reg">
						<button type="button" class="btn btn-default login_button" data-toggle="modal" data-target="#loginModal">Войти</button>
						<a href="/registration" class="btn btn-default reg_button">Регистрация</a>
					</div>
					@if (\App\Setting::getDiscount()>0)
						<div class="start_mes alert alert-info alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i aria-hidden="true" class="fa fa-times close_message"></i></button>
							<p class="mes_text_num">-{{\App\Setting::getDiscount()}}%</p>
							<p class="message_text start_text">при<br><a href="/registration" class="alert-link">регистрации</a></p>
						</div>
					@endif
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
				@endif
				{{ Form::open(array('url' => "/search", 'method' => 'GET', 'class'=>'header_search')) }}
				{{ Form::text('query', null, ['placeholder'=>"Поиск по каталогу", 'class'=>'form-control input_search', 'id' =>'search']) }}
				{{ Form::submit('Поиск', ['class' => 'btn search_btn', 'id' => 'search_btn']) }}
				{{ Form::close() }}
			</div>
		</div>
		@include('user-interface.partials.navbar')
	</header>
	{{--</div>	--}}
	{{--</div>--}}
@stop