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
			<li class="active">Корзина</li>
		</ol>
		<h2 class="about_heading universal_heading">Корзина</h2>
		<hr class="main_hr">
		<div class="about_text_block about_text_block--cart">
			<div class="cart_items_block">
				@foreach($cart_items as $item)
					<div class="one_cart_item @if($loop->last) last @endif">
						<div class="item-inner item-order">
							<p class="heading">№</p>
							<p>{{$loop->index+1}}</p>
						</div>
						<div class="item-inner item-title">
							<p class="heading">Название:</p>
							<a href="{{route('item', [str_slug($item->category), str_slug($item->subcat), str_slug($item->title)])."?item_id=$item->id"}}" target="_blank">
								{{$item->title}}
							</a>
						</div>
						<div class="item-inner item-price">
							<p class="heading">Цена:</p>
							@if(\Auth::check())
								<p>{{discount_price($item->price)}} руб.</p>
							@else
								<p>{{$item->price}} руб.</p>
							@endif
						</div>
						<div class="item-inner item-quantity">
							<p>Кол-во:</p>
							<input
									type="number"
									min="1"
									class="cart_input form-control countItemsEvent"
									name="count[{{$item->id}}]" data-id="{{$item->id}}"
									@if(\Auth::check())
										data-price="{{discount_price($item->price)}}"
									@else
										data-price="{{$item->price}}"
									@endif
									value="{{$item->count}}"
							>
						</div>
						<div class="item-inner item-total">
							<span class="cart_item_sum">
								Сумма:
								<span id="itemTotal_{{$item->id}}">
									@if(\Auth::check())
										{{discount_price($item->price) * $item->count}}
									@else
										{{$item->price * $item->count}}
									@endif
								</span> руб.
							</span>
						</div>
						<div class="buttons">
							<a href=""
							   class="btn btn-default items_button items_order js_item_remove"
							   data-id="{{$item->id}}"
							   @if(\Auth::check())
							   		data-price="{{discount_price($item->price)}}"
							   @else
							   		data-price="{{$item->price}}"
							   @endif
							>
								Убрать из корзины
							</a>
						</div>
					</div>
				@endforeach
			</div>
			<div class="bottom_block">
{{--				<a href="{{route('order_page')."?step=1"}}" class="btn btn-default items_button items_order">Оформить заказ</a>--}}
				<a href="{{route('order_page')}}" class="btn btn-default items_button items_order">Оформить заказ</a>
				<div class="in_total">
					<p>ИТОГО:</p>
					<p class="general_amount"><span class="totalAmountContainer">0</span>
					</p><p class="currency">руб.</p>
					<p></p>
				</div>
			</div>
		</div>
	</div>
@stop