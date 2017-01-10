<div class="most_viewed mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
	<h4 class="mdl-typography--display-1 main_heading">Самые популярные товары</h4>
	<ul class="demo-list-control mdl-list">
		@foreach($mostViewedItems as $item)
			@include('admin.dashboard.item-for-list')
		@endforeach
	</ul>
</div>
<div class="most_selling mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
	<h4 class="mdl-typography--display-1 main_heading">Самые продаваемые товары</h4>
	<ul class="demo-list-control mdl-list">
		@foreach($mostSellingItems as $item)
			<li class="mdl-list__item">
				<span class="mdl-list__item-primary-content">
					{{$item->title}} ({{$item->sales}} продано)
				</span>
				<span class="mdl-list__item-secondary-action" id="switch_{{$item->item_id}}">
					<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="list-switch-{{$item->item_id}}">
						<input
								type="checkbox"
								id="list-switch-{{$item->item_id}}"
								data-id="{{$item->item_id}}"
								class="mdl-switch__input list_make_hit"
								@if($item->hit == 1) checked @endif
						/>
					</label>
				</span>
				<div class="mdl-tooltip" for="switch_{{$item->item_id}}">
					Сделать хитом<br>продаж
				</div>
			</li>
		@endforeach
	</ul>
</div>