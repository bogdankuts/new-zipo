@section('header')
	<div @if($snow == 1)class="snow_container" @endif>
		<div @if($snow == 1)id="snow" @endif>
			<header>
				<hr class="header_top_hr">
				<div class="container_zipo">
					<div class="header_right">
						<div class="header_contacts">
							<p class="header_phone">тел. {{$p_phone->value}}</p><br>
							<p class="header_phone">тел. {{$s_phone->value}}</p>
						</div>
						<a href="/" class="logo_header">
							@if($snow == 0)
								{{ Html::image("img/markup/logo.png", "ЗипОбщепит", ['class'=>'logo_header']) }}
							@else
								{{ Html::image("img/markup/logo_winter.png", "ЗипОбщепит", ['class'=>'logo_header']) }}
							@endif
						
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
						@endif
						{{ Form::open(array('url' => "/search", 'method' => 'GET', 'class'=>'header_search')) }}
						{{ Form::text('query', null, ['placeholder'=>"Поиск по каталогу", 'class'=>'form-control input_search', 'id' =>'search']) }}
						{{ Form::submit('Поиск', ['class' => 'btn search_btn', 'id' => 'search_btn']) }}
						{{ Form::close() }}
					</div>
				</div>
				@include('user-interface.partials.navbar')
			</header>
		</div>
	</div>
@stop