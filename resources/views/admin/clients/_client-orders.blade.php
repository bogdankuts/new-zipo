@foreach($orders as $order)
	<div class="mdl-card mdl-shadow--2dp one_order">
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
					<p class="value">{{$order->sum}} руб.</p>
				</div>
				<div class="line">
					<p class="heading">Доставка</p>
					<p class="value">{{$order->delivery}}</p>
				</div>
				<div class="line">
					<p class="heading">Стасус</p>
					<p class="value">{{$order->state_title}}</p>
				</div>
			</div>
			<div class="items_part">
				<p class="title">Товары в заказе</p>
				@include('admin.orders._items-as-table')
			</div>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<a href="{{route('admin_order', [$order->order_id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Подробнее
			</a>
		</div>
	</div>
@endforeach