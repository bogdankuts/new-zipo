<div class="empty_scape">
	@if ($item->hit&&$item->special)
		{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
		{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
	@elseif ($item->hit)
		{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
	@elseif ($item->special)
		{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
	@endif
	<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one admin_items"><!--last class is for admin css-->
		<div class="admin_items_buttons">
			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect item_selected_checkbox" for="{{$item->item_id}}">
				{{ Form::checkbox('selcted', true, false, ['class'=>'mdl-checkbox__input', 'data-id'=>$item->item_id, 'id'=>$item->item_id]) }}
			</label>
			<!-- Right aligned menu below button -->
			<button id="{{$item->item_id}}-menu-trigger" class="mdl-button mdl-js-button mdl-button--icon admin_item_menu_trigger">
				<i class="material-icons">more_vert</i>
			</button>
			<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="{{$item->item_id}}-menu-trigger">
				<li class="mdl-menu__item">
					<a href="{{route('change_item', [$item->item_id])}}">
						Изменить
					</a>
				</li>
				@if (Auth::guard('admin')->user()->master)
					{{ Form::open(array('url' => route('delete_item_from_group', [$item->item_id]), 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
					<li class="mdl-menu__item js_trigger_closet_form">
						Удалить
					</li>
					{{ Form::close() }}
				@endif
			</ul>
		</div>
		<div class="items_item_text_block">
			<div class="items_item_heading">
				<div class="name_and_code">
					<div class="items_item_name_div">
						<p class="items_item_name">{{$item->title}}</p>
						<p class="items_item_name_full">{{$item->title}}</p>
					</div>
				</div>
				<div class="items_item_code_div">
					<p class="items_item_code">Арт: {{$item->code}}</p>
					<p class="items_item_code_full">Арт: {{$item->code}}</p>
				</div>
				@if ($item->price == 0.00)
					<div class="items_item_price_div">
						<p class="items_item_price">По запросу&nbsp</p>
						<p class="items_item_currency"></p>
					</div>
				@else
					<div class="items_item_price_div">
						<p class="items_item_price">{{$item->price}}&nbsp</p>
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
						<td class="items_item_dyn_text">{{$item->producer}}</td>
					</tr>
					<tr>
						<td>Код:</td>
						<td class="items_item_dyn_text">{{$item->code}}</td>
					</tr>
					<tr>
						<td>Тип:&nbsp</td>
						<td class="items_item_dyn_text">{{$item->subcat}}</td>
					</tr>
					<tr>
						<td>Наличие:&nbsp</td>
						<td class="items_item_dyn_text">{{$item->supply_title}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
