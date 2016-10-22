@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($clients as $client)
			<div class="mdl-card mdl-shadow--2dp one_client">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Клиент {{$client->name}} {{$client->surname}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="client_part">
						<div class="line">
							<p class="heading">Имя</p>
							<p class="value">{{$client->name}}</p>
						</div>
						<div class="line">
							<p class="heading">Фамилия</p>
							<p class="value">{{$client->surname}}</p>
						</div>
						<div class="line">
							<p class="heading">Компания</p>
							<p class="value">{{$client->company}}</p>
						</div>
						<div class="line">
							<p class="heading">Email</p>
							<a href="mailto:{{$client->email}} " class="value">{{$client->email}}</a>
						</div>
						<div class="line">
							<p class="heading">Телефон</p>
							<p class="value">{{$client->phone}}</p>
						</div>
						<div class="line">
							<p class="heading">Форма собсвтенности</p>
							<p class="value">{{$client->form_of_business}}</p>
						</div>
						<div class="line">
							<p class="heading">Дата первого заказа</p>
							<p class="value">{{$client->added_at}}</p>
						</div>
						<div class="line">
							<p class="heading">Всего заказов</p>
							<p class="value">{{$client->total_orders}}</p>
						</div>
						<div class="line">
							<p class="heading">На сумму</p>
							<p class="value">{{$client->total_orders_sum}} руб.</p>
						</div>
						<div class="line">
							<p class="heading">Зарегестрирован</p>
							@if($client->registered)
								<p class="value">Да</p>
							@else
								<p class="value">Нет</p>
							@endif
						</div>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('admin_client', [$client->client_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
				</div>
			</div>
		@endforeach
	</div>
@stop
