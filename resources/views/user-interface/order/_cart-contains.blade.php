@if($step == 5)
	<p class="contents">Товары в заказе</p>
@else
	<p class="contents">Содержимое вашей корзины</p>
@endif
<div class="cart_items_block about_text_block--cart">
	@foreach($items as $item)
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
				<p class="item-price-p" data-id="{{$item->id}}">
					@if(!$item->sales->isEmpty() && $step != 5)
						{{salesPrice($item->price, $item->sales[0]->discount)}}
					@elseif(\Auth::check() && $step != 5)
						{{round(discount_price($item->price))}} руб.
					@else
						{{round($item->price)}} руб.
					@endif
				</p>
				<input type="hidden" value="{{$item->price}}" class="js_to_discount">
			</div>
			<div class="item-inner item-quantity">
				<p>Кол-во:</p>
				<p class="cart_input">{{$item->count}}</p>
			</div>
			<div class="item-inner item-total">
				<p>Сумма:</p>
				<p class="cart_item_sum">
					<span id="itemTotal_{{$item->id}}">
						@if(!$item->sales->isEmpty() && $step != 5)
							{{salesPrice($item->price, $item->sales[0]->discount)}}
						@elseif(\Auth::check() && $step != 5)
							{{round(discount_price($item->price * $item->count))}}
						@else
							{{round($item->price * $item->count)}}
						@endif
					</span> руб.
				</p>
			</div>
		</div>
	@endforeach
	<div class="bottom_block">
		<div class="order_in_total">
			@if($step == 5)
				<p>ИТОГО(с учетом скидок):</p>
			@else
				<p>ИТОГО:</p>
			@endif
			<p class="general_amount">
				<span class="" id="">{{round($cartSum)}}</span>
			</p><p class="currency">руб.</p>
			<p></p>
		</div>
	</div>
</div>