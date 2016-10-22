@extends('user-interface.layout')
@include('user-interface.partials.initial-meta')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="{{route('index')}}">Главная</a></li>
			<li class="active">Контакты</li>
		</ol>
		<h2 class="about_heading universal_heading">Контакты</h2>
		<hr class="main_hr">
		<div class="about_text_block">
			<table class="contacts_info_table">
				<tr>
					<td class="info_label">Адрес</td>
					<td>г. Санкт-Петербург, Гаврская улица дом 15</td>
				</tr>
				<tr>
					<td class="info_label">Телефон</td>
					<td>{{$p_phone->value}}</td>
				</tr>
				<tr>
					<td class="info_label">Доп. телефон</td>
					<td>{{$s_phone->value}}</td>
				</tr>
				<tr>
					<td class="info_label">Эл. почта</td>
					<td><a href="mailto:{{$email->value}}">{{$email->value}}</a></td>
				</tr>
				<tr>
					<td class="info_label">Дополнительный сайт</td>
					<td><a href="http://www.mssservice.ds78.ru" target="_blank">mssservice.ds78.ru</a></td>
				</tr>
				<tr>
					<td class="info_label">Контактное лицо</td>
					<td>Дежурный менеджер</td>
				</tr>
				<tr>
					<td class="info_label">Часы работы</td>
					<td>
						ПН-ПТ {{$timeWeekFrom}} - {{$timeWeekTo}}, без перерыва,
						@if($timeSatFrom !== '0')
							@if($timeSatFrom !=='')
								СБ - {{$timeSatFrom}} - {{$timeSatTo}}
							@else
								СБ - по договоренности
							@endif
						@else
							СБ - выходной
						@endif

						@if($timeSunFrom !== '0')
							@if($timeSunFrom !== '')
								ВС - {{$timeSunFrom}} - {{$timeSunTo}}
							@else
								ВС - по договоренности
							@endif
						@else
							ВС - выходной
						@endif
					</td>
				</tr>
			</table>
		</div>
		<p class="conacts_subheading">Если у вас остались вопросы - напишите нам.</p>
		<div class="contacts_contact_form" id="contact_sorm_ancher">
			{{ Form::open(['url'=>'/feedback', 'method'=>'POST', 'class'=>'item_form admin_info_form']) }}
			<table class="contacts_form_table">
				<tr>
					<td class="req">{{ Form::label('name', 'Имя: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('name', null, ['class'=>'change_input_contacts form-control req', 'required']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('company', 'Компания: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('company', null, ['class'=>'change_input_contacts form-control']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('phone', 'Контактный телефон: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('phone', null, ['class'=>'change_input_contacts form-control']) }}</td>
				</tr>
				<tr>
					<td class="req">{{ Form::label('email', 'E-mail: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::email('email', null, ['class'=>'change_input_contacts form-control req', 'required']) }}</td>
				</tr>
				<tr>
					<td>{{ Form::label('theme', 'Тема письма: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::text('theme', null, ['class'=>'change_input_contacts form-control']) }}</td>
				</tr>
				<tr>
					<td class="req">{{ Form::label('body', 'Текст: ', ['class'=>'main_label']) }}</td>
					<td>{{ Form::textarea('body', null, ['class'=>'change_input_contacts contacts_form_body form-control req', 'required']) }}</td>
				</tr>
			</table>
			{{ Form::submit('Отправить', ['class'=>'btn submit_field save_button']) }}
			{{ Form::close() }}
		</div>
		<iframe
				width="550"
				height="300"
				frameborder="0"
				style="border:0"
				src="https://www.google.com/maps/embed/v1/place?q=%D0%B3.%D0%A1%D0%B0%D0%BD%D0%BA%D1%82-%D0%9F%D0%B5%D1%82%D0%B5%D1%80%D0%B1%D1%83%D1%80%D0%B3%2C%D1%83%D0%BB%20%D0%93%D0%B0%D0%B2%D1%80%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B4%D0%BE%D0%BC%2015.&key=AIzaSyCbbmQ7zwLFLhzf82djdLZHzrGB8BmPyKU" allowfullscreen>
		</iframe>
	</div>
@stop