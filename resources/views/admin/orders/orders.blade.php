@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')
@extends('admin.modals.add-state')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content admin_main_content--orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach($orders as $order)
			<div class="mdl-card mdl-shadow--2dp one_order" id="{{$order->order_id}}">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">Заказ № {{$order->order_id}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="order_part">
						<p class="title">Подробности заказа</p>
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
							<p class="heading">Стасус</p>
							{{ Form::select('state_id', createOptions($states, 'state_id', 'state_title'), $order->state, ['class'=>'form-control state', 'required', 'form' => 'none', 'data-target' => $order->order_id]) }}
						</div>
					</div>
					<div class="client_part">
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
								<a href="mailto:{{$order->email}} " class="value">{{$order->email}}</a>
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
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('admin_order', [$order->order_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
					<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect about_client" id="more_{{$order->order_id}}" data-target="{{$order->order_id}}">
						Подробнее о клиенте
					</a>
					<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect client_less" id="less_{{$order->order_id}}" data-target="{{$order->order_id}}">
						Скрыть
					</a>

				</div>
				<div class="mdl-card__menu">
					<button id="{{$order->order_id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$order->order_id}}-menu-trigger">
						<li class="mdl-menu__item mark_order_done" data-id="{{$order->order_id}}">
							<p>Отметить как выполненный</p>
						</li>
						@if (Auth::guard('admin')->user()->master)
							{{Form::open(['url' => route('delete_order', [$order->order_id]), 'method' => 'POST', 'class'=>'admin_producer_one_form'])}}
								<li class="mdl-menu__item js_trigger_closet_form" data-id="{{$order->order_id}}">
									<p>Удалить</p>
								</li>
							{{ Form::close() }}
						@endif
					</ul>
				</div>
			</div>
		@endforeach
		<div class="add_btn" id="add_btn">
			<a class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#addState">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить статус заказа
		</div>
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/orders.js') }}
	{{ Html::script('js/admin/make-order-done.js') }}
	{{ Html::script('js/admin/trigger-delete-form.js') }}
@stop

