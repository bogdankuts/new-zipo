<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('title', 'Название', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('title', $sale->title, ['class'=>'mdl-textfield__input', 'required', 'id' => 'title', 'maxlength'=>'128']) }}
		@else
			{{ Form::text('title', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'title', 'maxlength'=>'128']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('url', 'URL(латиница)', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('url', $sale->url, ['class'=>'mdl-textfield__input', 'required', 'id' => 'url', 'maxlength'=>'128']) }}
		@else
			{{ Form::text('url', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'url', 'maxlength'=>'128']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('start_date', 'Начало', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('start_date', $sale->start_date->format('d.m.Y H:i'), ['class'=>'mdl-textfield__input datepicker-here select', 'required', 'id' => 'start_date', 'maxlength'=>'128', 'data-timepicker' => 'true']) }}
		@else
			{{ Form::text('start_date',\Carbon\Carbon::now()->format('d.m.Y H:i'), ['class'=>'mdl-textfield__input datepicker-here select', 'required', 'id' => 'start_date', 'maxlength'=>'128', 'data-timepicker' => 'true']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('end_date', 'Конец', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('end_date', $sale->end_date->format('d.m.Y H:i'), ['class'=>'mdl-textfield__input datepicker-here select', 'required', 'id' => 'end_date', 'maxlength'=>'128', 'data-timepicker' => 'true']) }}
		@else
			{{ Form::text('end_date', \Carbon\Carbon::now()->format('d.m.Y H:i'), ['class'=>'mdl-textfield__input datepicker-here select', 'required', 'id' => 'end_date', 'maxlength'=>'128', 'data-timepicker' => 'true']) }}
		@endif
	</div>
</div>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
	{{ Form::label('discount', 'Скидка(%)', ['class'=>'mdl-textfield__label']) }}
	@if(isset($sale))
		{{ Form::number('discount', $sale->discount*100, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discount', 'maxlength'=>'11', 'pattern'=>'-?[0-9]*(\.[0-9]+)?']) }}
	@else
		{{ Form::number('discount', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discount', 'maxlength'=>'11', 'pattern'=>'-?[0-9]*(\.[0-9]+)?']) }}
	@endif
</div>
<div class="change_block change_item_descript_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::textarea('description', null, ['class'=>'mdl-textfield__input', 'rows'=>"10", 'id' =>'description']) }}
		{{ Form::label('description', 'Описание', ['class'=>'mdl-textfield__label']) }}
	</div>
</div>
<div class="change_item_buttons">
	{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
	{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
	<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
</div>

<p class="admin_uni_label admin_uni_label--subheading">Добавить баннер для распродажи(1150px*200px)</p>

<div class="change_article_img">
	<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="{{route('ajax_image_sale')}}" multiple form='none'>
	<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать баннер</a>
</div>

<div class="img_preview sale-img-preview">
	@if (isset($sale->banner) && $sale->banner != 'no_photo.png')
		<img src="/img/photos/sales/{{$sale->banner }}" class='items_item_img' data-filepath='{{ public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'sales'.DIRECTORY_SEPARATOR.$sale->banner }}'>
		<i class="material-icons delete_img_icon_ajax">close</i>
		{{ Form::hidden('old', $sale->banner ) }}
		{{ Form::hidden('photo', $sale->banner , ['class' => 'inserted_input']) }}
	@else
		{{ Form::hidden('old', 'no_photo.png') }}
		{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
		<img src="/img/photos/no_photo.png" class='items_item_img' >
	@endif
</div>