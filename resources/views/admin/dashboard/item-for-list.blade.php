<li class="mdl-list__item">
	<span class="mdl-list__item-primary-content">
		{{$item->title}} ({{$item->visits}} посещения(ий))
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