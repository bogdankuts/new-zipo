@extends('user-interface.layout')
@include('user-interface.partials.initial-meta')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('body')
	{{--@if ($errors->has())--}}
		{{--<div class="message alert alert-danger alert-dismissible" role="alert">--}}
			{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i aria-hidden="true" class="fa fa-times close_message"></i></button>--}}
			{{--<p class="error_message">--}}
				{{--@foreach ($errors->all() as $error)--}}
					{{--{{ $error }}<br>--}}
				{{--@endforeach--}}
			{{--</p>--}}
		{{--</div>--}}
	{{--@endif--}}
	<div class="main_content">
		<h2 class="registration_heading universal_heading">Регистрация</h2>
		<hr class="main_hr">
		{{ Form::open(['url'=>'/registration', 'method'=>'POST', 'class'=>'register_form']) }}
		<table class="change_input_register">
			<tr>
				<td class="req">{{ Form::label('name', 'Имя: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::text('name', null, ['class'=>'change_input_register form-control', 'required']) }}</td>
			</tr>
			<tr>
				<td class="req">{{ Form::label('surname', 'Фамилия: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::text('surname', null, ['class'=>'change_input_register form-control', 'required']) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('company', 'Компания: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::text('company', null, ['class'=>'change_input_register change_input_register_code form-control']) }}</td>
			</tr>
			<tr>
				<td class="req">{{ Form::label('email', 'E-Mail: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::text('email', null, ['class'=>'change_input_register change_input_register_code form-control', 'required']) }}</td>
			</tr>
			<tr>
				<td class="req">{{ Form::label('phone', 'Телефон: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::text('phone', null, ['class'=>'change_input_register change_input_register_code form-control', 'required']) }}</td>
			</tr>
			<tr>
				<td>{{ Form::label('activity', 'Род деятельности: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::select('activity',['Технолог' => 'Технолог','Владелец' => 'Владелец', 'Инжинер' => 'Инженер'], '', ['class'=>'change_input_register change_input_register_code form-control']) }}</td>
			</tr>
			<tr>
				<td class="req">{{ Form::label('password', 'Пароль: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::password('password', ['class'=>'change_input_register change_input_register_short form-control','required']) }}</td>
			</tr>
			<tr>
				<td class="req">{{ Form::label('confirm', 'Подтверждение пароля: ', ['class'=>'main_label']) }}</td>
				<td>{{ Form::password('confirm', ['class'=>'change_input_register change_input_register_code form-control', 'required']) }}</td>
			</tr>
		</table>
		{{ Form::submit('Регистрация', ['class'=>'btn submit_field save_button']) }}
		{{ Form::close() }}
	</div>
@stop