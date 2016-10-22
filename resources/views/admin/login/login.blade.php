@extends('admin.layout')

@section('body')
	<div class="login_page">
		<div class="filter">
		</div>
{{--		@include('partials/flash_messages')--}}
		<div class='login_section'>
			<div class="login_card mdl-card mdl-shadow--2dp">
				<h4>Добро пожаловать!</h4>
				{{ Form::open(['url' => '/admin_login']) }}
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					{{ Form::label('login', 'Логин', ['class'=>'mdl-textfield__label']) }}
					{{ Form::text('login', null, ['class'=>'mdl-textfield__input', 'id' => 'login']) }}
				</div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					{{ Form::label('password', 'Пароль', ['class'=>'mdl-textfield__label']) }}
					{{ Form::password('password', ['class'=>'mdl-textfield__input', 'id' => 'password', 'autocomplete'=>"off"]) }}
				</div>
				{{ Form::submit('Войти', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent submit_login']) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop