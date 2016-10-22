@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col client">
		<h1>Пользователь {{$user->name}} {{$user->surname}}</h1>
		<div class="main">
			<div class="line">
				<p class="heading">Имя</p>
				<p class="value">{{$user->name}}</p>
			</div>
			<div class="line">
				<p class="heading">Фамилия</p>
				<p class="value">{{$user->surname}}</p>
			</div>
			<div class="line">
				<p class="heading">Компания</p>
				<p class="value">{{$user->company}}</p>
			</div>
			<div class="line">
				<p class="heading">Email</p>
				<a href="mailto:{{$user->email}} " class="value">{{$user->email}}</a>
			</div>
			<div class="line">
				<p class="heading">Телефон</p>
				<p class="value">{{$user->phone}}</p>
			</div>
		</div>
		<div class="history">
			<div class="line">
				<p class="heading">Дата регистрации</p>
				<p class="value">{{$user->timestamp}}</p>
			</div>
			<div class="line">
				<p class="heading">Всего заказов</p>
				@if($user->total_orders != '')
					<p class="value">{{$user->total_orders}}</p>
				@else
					<p class="value">0</p>
				@endif
			</div>
			<div class="line">
				<p class="heading">На сумму</p>
				@if($user->total_orders_sum != '')
					<p class="value">{{$user->total_orders_sum}} руб.</p>
				@else
					<p class="value">0 руб.</p>
				@endif
			</div>
		</div>
		<div class="orders">
			@if(!count($orders) == 0)
				<h1>Заказы пользователя</h1>
				@include('admin.clients._client-orders')
			@endif
		</div>
	</div>
@stop