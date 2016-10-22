@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col client">
		<h1>Клиент {{$client->name}} {{$client->surname}}</h1>
		<div class="main">
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
		</div>
		<div class="history">
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
		<div class="orders">
			<h1>Заказы клиента</h1>
			@include('admin.clients._client-orders')
		</div>
	</div>
@stop
