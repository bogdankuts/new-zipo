<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('title', 'Название', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('title', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'title']) }}
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('meta_title', 'Meta-title', ['class'=>'mdl-textfield__label meta_title_label']) }}
		{{ Form::text('meta_title', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'meta_title', 'maxlength'=>'70']) }}
	</div>
	<div class="mdl-tooltip" for="meta_title">
		Параметр, для SEO, должен <br>должен коротко и ясно отражать суть страницы<br> Максимум 70 символов
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('meta_description', 'Meta-description', ['class'=>'mdl-textfield__label']) }}
		{{ Form::text('meta_description', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'meta_description', 'maxlength'=>'200']) }}
	</div>
	<div class="mdl-tooltip" for="meta_description">
		Параметр, для SEO, должен <br> должен описывать содержание конкретной страницы<br> Максимум 200 символов
	</div>
</div>
<div class="one_row">
	<div class="change_block change_item_code_block">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('code', 'Артикул', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('code', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'code']) }}
		</div>
	</div>
	<div class="change_block change_item_price_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('price', 'Цена', ['class'=>'mdl-textfield__label']) }}
			{{ Form::number('price', null, ['class'=>'mdl-textfield__input', 'required', 'onkeypress'=>'validate(event)', 'step'=> '0.000001']) }}
		</div>
	</div>
	<div class="change_block change_item_cur_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('currency', 'Валюта', ['class'=>'admin_uni_label']) }}
			{{ Form::select('currency', ['РУБ'=>'RUB', 'EUR'=>'EUR'], 'РУБ', ['class'=>'form-control currency_input', 'required']) }}
		</div>
	</div>
	<div class="change_block change_item_procurement_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('procurement', 'Наличие', ['class'=>'admin_uni_label producer_label']) }}
			{{ Form::select('procurement', createOptions($supplies, 'id', 'supply_title'), null, ['class'=>'form-control producer_input', 'required']) }}
		</div>
	</div>
</div>
<div class="one_row">
	<div class="change_block change_item_category_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_label']) }}
			{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
			@if (isset($item))
				{{ Form:: hidden('categoryActive', $item->category, ['id'=>'categoryActive']) }}
			@else
				{{ Form:: hidden('categoryActive', '', ['id'=>'categoryActive']) }}
			@endif
		</div>
	</div>
	<div class="change_block change_item_subcat_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_label']) }}
			{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text', 'required', 'id'=>'SubcategoriesSelect']) }}
			@if (isset($item))
				{{ Form:: hidden('subcategoryActive', $item->subcat_id, ['id'=>'subcategoryActive']) }}
			@else
				{{ Form:: hidden('subcategoryActive', '', ['id'=>'subcategoryActive']) }}
			@endif
		</div>
	</div>
	<div class="change_block change_item_producer_div">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label producer_label']) }}
			{{ Form::select('producer_id', createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input producer_input--producer', 'required', 'data-no_results_text' => 'Нет результатов по запросу']) }}
		</div>
	</div>
</div>
<div class="one_row">
	<div class="change_block change_item_descript_block">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::textarea('description', null, ['class'=>'mdl-textfield__input', 'rows'=>"10", 'id' =>'description']) }}
			{{ Form::label('description', 'Описание', ['class'=>'mdl-textfield__label']) }}
		</div>
	</div>
	<div class="make_spec_block">
		@if (isset($item))
			@if($item->special == 1)
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" for="special">
					{{ Form::checkbox('special', true, true, ['class'=>'mdl-switch__input', 'id'=>'special']) }}
					<span class="mdl-switch__label">Добавить в спецпредложения</span>
				</label>
			@else
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="special">
					{{ Form::checkbox('special', true, false, ['class'=>'mdl-switch__input', 'id'=>'special']) }}
					<span class="mdl-switch__label">Добавить в спецпредложения</span>
				</label>
			@endif
		@else
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="special">
				{{ Form::checkbox('special', true, false, ['class'=>'mdl-switch__input', 'id'=>'special']) }}
				<span class="mdl-switch__label">Добавить в спецпредложения</span>
			</label>
		@endif
	</div>
	<div class="make_hit_block">
		@if (isset($item))
			@if($item->hit == 1)
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" for="hit">
					{{ Form::checkbox('hit', true, true, ['class'=>'mdl-switch__input', 'id'=>'hit']) }}
					<span class="mdl-switch__label">Сделать хитом продаж</span>
				</label>
			@else
				<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect is-checked" for="hit">
					{{ Form::checkbox('hit', true, false, ['class'=>'mdl-switch__input', 'id'=>'hit']) }}
					<span class="mdl-switch__label">Сделать хитом продаж</span>
				</label>
			@endif
		@else
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="hit">
				{{ Form::checkbox('hit', true, false, ['class'=>'mdl-switch__input', 'id'=>'hit']) }}
				<span class="mdl-switch__label">Сделать хитом продаж</span>
			</label>
		@endif
	</div>
</div>
<p class="admin_uni_label admin_uni_label--subheading">Добавить изображение 110*95 пикс.</p>
<div class="change_item_img">
	<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="{{route('ajax_image')}}" multiple form='none'>
	<a id="trigger_link_img" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent select_img_trigger">Выбрать картинку</a>
</div>
<div class="img_preview">
	@if (isset($item->photo) && $item->photo != 'no_photo.png')
		<img src="/img/photos/items/{{$item->photo}}" class='items_item_img' data-filepath='{{ public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'items'.DIRECTORY_SEPARATOR.$item->photo }}'>
		<i class="material-icons delete_img_icon_ajax">close</i>
		{{ Form::hidden('old', $item->photo) }}
		{{ Form::hidden('photo', $item->photo, ['class' => 'inserted_input']) }}
	@else
		{{ Form::hidden('old', 'no_photo.png') }}
		{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
		<img src='{{ URL::to("img/photos/")}}/{{ "no_photo.png" }}' class='items_item_img' >
	@endif
</div>
<div class="change_item_buttons">
	<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
	{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
</div>