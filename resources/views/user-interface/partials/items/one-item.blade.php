<div class="empty_scape item_{{$item->item_id}}">
	@if ($item->hit && $item->special)
		{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
		{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
	@elseif ($item->hit)
		{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
	@elseif ($item->special)
		{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
	@endif
	<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one">
		<div class="items_item_text_block">
			<div class="items_item_heading">
				<div class="name_and_code">
					<div class="items_item_name_div">
						<a href="{{route('item', [str_slug($item->category), str_slug($item->subcat), str_slug($item->title)])."?item_id=$item->item_id"}}" class="items_item_name">
							{{$item->title}}
						</a>
						<a href="{{route('item', [str_slug($item->category), str_slug($item->subcat), str_slug($item->title)])."?item_id=$item->item_id"}}" class="items_item_name_full">
							{{$item->title}}
						</a>
					</div>
				</div>
				<div class="items_item_code_div">
					<p class="items_item_code">Арт: {{$item->code}}</p>
					<p class="items_item_code_full">Арт: {{$item->code}}</p>
				</div>
				@if($item->price == 0.00)
					<div class="items_item_price_div">
						<p class="items_item_price">По запросу&nbsp</p>
						<p class="items_item_currency"></p>
					</div>
				@else
					<div class="items_item_price_div @if(!$item->activeSales->isEmpty())discounted @endif">
						@if(!$item->activeSales->isEmpty())
							<div class="discount-block">
								<p>Скидка - {{$item->activeSales[0]->discount * 100}} %</p>
							</div>
							<div class="old">
								<p class="items_item_price">{{ceil($item->price)}}&nbsp</p>
								<p class="items_item_currency">руб.</p>
							</div>
							<p class="items_item_price">{{salesPrice($item->price, $item->sales[0]->discount)}}&nbsp</p>
						@elseif (Auth::user())
							<p class="items_item_price">{{discount_price($item->price)}}&nbsp</p>
						@else
							<p class="items_item_price">{{$item->price}}&nbsp</p>
						@endif
						<p class="items_item_currency">руб.</p>
					</div>
				@endif
			</div>
			<div class="items_item_descript">
				{{ Html::image("img/photos/items/$item->photo", "$item->title", ['class'=>'items_page_item_img']) }}
				<table class="items_item_text">
					<tr>
						<td colspan='2' class="small_heading">Характеристики</td>
					</tr>
					<tr>
						<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
						@if(\Request::route()->getName() == 'one_pdf')
							<td class="items_item_dyn_text">{{$item->producer}}</td>
						@else
							<td class="items_item_dyn_text">{{$item->producer}}</td>
						@endif
					</tr>
					<tr>
						<td>Код:</td>
						<td class="items_item_dyn_text">{{$item->code}}</td>
					</tr>
					<tr>
						<td>Тип:&nbsp</td>
						@if(\Request::route()->getName() == 'one_pdf')
							<td class="items_item_dyn_text">{{$item->subcat}}</td>
						@else
							<td class="items_item_dyn_text">{{$item->subcat}}</td>
						@endif
					</tr>
					<tr>
						<td>Наличие:&nbsp</td>
						<td class="items_item_dyn_text">{{$item->supply_title}}</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="items_buttons">
			<a href="{{route('item', [str_slug($item->category), str_slug($item->subcat), str_slug($item->title)])."?item_id=$item->item_id"}}" class="btn btn-default items_button items_more">
				Подробнее
			</a>
			@if(!$item->sales->isEmpty())
				<a href="" class="btn btn-default items_button items_order js_item_add" data-id="{{$item->item_id}}" data-price="{{salesPrice($item->price, $item->sales[0]->discount)}}">В корзину</a>
			@elseif (Auth::user())
				<a href="" class="btn btn-default items_button items_order js_item_add" data-id="{{$item->item_id}}" data-price="{{discount_price($item->price)}}">В корзину</a>
			@else
				<a href="" class="btn btn-default items_button items_order js_item_add" data-id="{{$item->item_id}}" data-price="{{$item->price}}">В корзину</a>
			@endif
			<a href="{{route('cart')}}" class="btn btn-default items_button items_order items_order--delete js_item_cart">Корзина</a>
			<a href="" class="btn btn-default items_button items_order items_order--delete js_item_remove" data-id="{{$item->item_id}}">Отменить</a>
		</div>
	</div>
</div>
