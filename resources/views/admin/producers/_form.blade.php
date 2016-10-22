<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('producer', 'Производитель', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('producer', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'producer']) }}
	</div>
</div>
<p class="admin_uni_label admin_uni_label--subheading">Добавить изображение 150*100 пикс.</p>
<div class="change_item_img">
	<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="{{route('ajax_image_producer')}}" multiple form='none'>
	<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать картинку</a>
</div>
<div class="img_preview">
	@if (isset($producer->producer_photo) && $producer->producer_photo != 'no_photo.png')
		<img src="/img/photos/producers/{{$producer->producer_photo}}" class='items_item_img' data-filepath='{{ public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'producers'.DIRECTORY_SEPARATOR.$producer->producer_photo }}'>
		<i class="material-icons delete_img_icon_ajax">close</i>
		{{ Form::hidden('old', $producer->producer_photo) }}
		{{ Form::hidden('photo', $producer->producer_photo, ['class' => 'inserted_input']) }}
	@else
		{{ Form::hidden('old', 'no_photo.png') }}
		{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
		<img src="/img/photos/no_photo.png" class='items_item_img' >
	@endif
</div>
<div class="change_item_buttons">
	<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent producer_clean low_button">Очистить</p>
	{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
</div>