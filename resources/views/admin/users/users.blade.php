@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col users">
		@foreach($users as $user)
			<div class="mdl-card mdl-shadow--2dp one_client">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Пользователь {{$user->name}} {{$user->surname}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="client_part">
						<div class="line line_name">
							<p class="heading">Имя</p>
							<p class="value">{{$user->name}}</p>
						</div>
						<div class="line">
							<p class="heading">Фамилия</p>
							<p class="value">{{$user->surname}}</p>
						</div>
						<div class="line">
							<p class="heading line_company">Компания</p>
							<p class="value line_company">{{$user->company}}</p>
						</div>
						<div class="line">
							<p class="heading">Email</p>
							<a href="mailto:{{$user->email}} " class="value">{{$user->email}}</a>
						</div>
						<div class="line">
							<p class="heading">Телефон</p>
							<p class="value">{{$user->phone}}</p>
						</div>
						<div class="line">
							<p class="heading">Род деятельности</p>
							<p class="value">{{$user->activity}}</p>
						</div>
						<div class="line">
							<p class="heading">Дата регистрации</p>
							<p class="value">{{$user->timestamp}}</p>
						</div>
						<div class="line">
							<p class="heading">Всего заказов</p>
							<p class="value">{{$user->total_orders}}</p>
						</div>
						<div class="line">
							<p class="heading">На сумму</p>
							<p class="value">{{$user->total_orders_sum}}</p>
						</div>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('admin_user', [$user->user_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
				</div>
			</div>
		@endforeach
	</div>
@stop