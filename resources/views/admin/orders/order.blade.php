@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content admin_main_content--orders mdl-cell mdl-cell--12-col order">
		<h2>Заказ №{{$order->order_id}}</h2>
		<div class="order_part mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<p class="title mdl-card__title-text">Подробности заказа</p>
			</div>
			<div class="line">
				<p class="heading">Клиент</p>
				<p class="value">{{$order->name}} {{$order->surname}}</p>
			</div>
			<div class="line">
				<p class="heading">Дата</p>
				<p class="value">{{$order->date}}</p>
			</div>
			<div class="line">
				<p class="heading">Сумма</p>
				@if ($order->delivery == 'Доставка до терминала ТК ПЭК в Санкт Петербурге.')
					@if ($order->sum < 20000)
						<p class="value">{{$order->sum + 200}} руб.</p>
					@else
						<p class="value">{{$order->sum}} руб.</p>
					@endif
				@elseif($order->delivery == 'Доставка до терминала ТК Деловые Линии в Санкт Петербурге.')
					@if ($order->sum < 20000)
						<p class="value">{{$order->sum + 150}} руб.</p>
					@else
						<p class="value">{{$order->sum}} руб.</p>
					@endif
				@elseif($order->delivery == 'Доставка до терминала ТК РАТЭК в Санкт Петербурге.')
					@if ($order->sum < 20000)
						<p class="value">{{$order->sum + 150}} руб.</p>
					@else
						<p class="value">{{$order->sum}} руб.</p>
					@endif
				@elseif($order->delivery == 'Доставка По Санкт Петербургу.')
					@if ($order->sum < 20000)
						<p class="value">{{$order->sum+350}} руб.</p>
					@else
						<p class="value">{{$order->sum}} руб.</p>
					@endif
				@else
					<p class="value">{{$order->sum}} руб.</p>
				@endif
			</div>
			<div class="line">
				<p class="heading">Доставка</p>
				<p class="value">{{$order->delivery}}</p>
			</div>
			<div class="line">
				<p class="heading">Оплата</p>
				@if($order->payment === 'card')
					<p class="value">Оплата на карту "Сбербанка"</p>
				@elseif ($order->payment === 'check')
					<p class="value">Оплата по счету(юр.лица)</p>
				@else
					<p class="value">Оплата по счету(физ.лица)</p>
				@endif
			</div>
			@if($order->address != '')
				<div class="line">
					<p class="heading">Адрес</p>
					<p class="value">{{$order->address}}</p>
				</div>
			@endif
			<div class="line">
				<p class="heading">Стасус</p>
				{{ Form::select('state_id', createOptions($states, 'state_id', 'state_title'), $order->state_id, ['class'=>'form-control state', 'required', 'form' => 'none', 'data-target' => $order->order_id]) }}
			</div>
			@if($order->comment != '')
				<div class="line">
					<p class="heading">Комментарий</p>
					<p class="value">{{$order->comment}}</p>
				</div>
			@endif
			@if($order->requisites != '')
				<div class="line">
					<p class="heading">Реквизиты</p>
					{{Html::link("/requisites/$order->requisites", "Заказ № $order->order_id реквизиты | загрузка",['target'=>'_blank', 'download'=>'', 'class' => 'value']) }}
				</div>
			@endif
			@if (Auth::guard('admin')->user()->master)
				<div class="delete_block">
					{{ Form::open(['url'=>route('delete_order', [$order->order_id]), 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
					{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
					{{ Form::close() }}
				</div>
			@endif
		</div>
		<div class="client_part mdl-card mdl-shadow--2dp">
			<p class="title">О клиенте</p>
			<div class="main">
				<div class="line">
					<p class="heading">Имя</p>
					<p class="value">{{$order->name}}</p>
				</div>
				<div class="line">
					<p class="heading">Фамилия</p>
					<p class="value">{{$order->surname}}</p>
				</div>
				<div class="line">
					<p class="heading">Компания</p>
					<p class="value">{{$order->company}}</p>
				</div>
				<div class="line">
					<p class="heading">Email</p>
					<a href="mailto::{{$order->email}}" class="value">{{$order->email}}</a>
				</div>
				<div class="line">
					<p class="heading">Телефон</p>
					<p class="value">{{$order->phone}}</p>
				</div>
			</div>
			<div class="additional">
				<div class="line">
					<p class="heading">Форма собсвтенности</p>
					<p class="value">{{$order->form_of_business}}</p>
				</div>
				<div class="line">
					<p class="heading">Дата первого заказа</p>
					<p class="value">{{$order->added_at}}</p>
				</div>
			</div>
			<div class="line">
				@if($order->number_of_order <= 1)
					<p class="heading clients_order">Это первый заказ клиента!</p>
				@else
					<p class="heading clients_order">Этот клиент сделал {{$order->number_of_order}} заказов(а)!</p>
				@endif
				<div class="client_more">
					<a href="{{route('admin_client', [$order->client_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее о клиенте
					</a>
				</div>
			</div>
		</div>
		<div class="items_part mdl-card mdl-shadow--2dp">
			<p class="title">Товары в заказе (всего: {{count($order->items)}})</p>
			@include('admin.orders._items-as-table')
			<div class="final_sum_block">
				<p class="general_sum">Сумма {{$order->sum}} руб.</p>
			</div>
		</div>
	</div>
	<div class="add_btn" id="add_btn">
		<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#addState">
			<i class="material-icons">add</i>
		</a>
	</div>
	<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
		Добавить статус заказа
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/orders.js') }}
@stop