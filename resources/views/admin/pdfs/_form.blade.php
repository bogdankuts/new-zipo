<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('good', 'Название', ['class'=>'mdl-textfield__label']) }}
		@if(isset($pdf))
			{{ Form::text('good', $pdf->good, ['class'=>'mdl-textfield__input', 'required', 'id' => 'good', 'maxlength'=>'128']) }}
		@else
			{{ Form::text('good', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'good', 'maxlength'=>'128']) }}
		@endif

	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_label']) }}
		@if(isset($pdf))
			{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $pdf->category, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
			{{ Form::hidden('categoryActive', $pdf->category, ['id'=>'categoryActive']) }}
		@else
			{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], null, ['class'=>'form-control', 'required', 'id'=>'CategorySelect']) }}
			{{ Form::hidden('categoryActive', '', ['id'=>'categoryActive']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_label']) }}
		{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text subcat-select', 'required', 'id'=>'SubcategoriesSelect']) }}
		@if (isset($pdf))
			{{ Form::hidden('subcategoryActive', $pdf->subcat_id, ['id'=>'subcategoryActive']) }}
		@else
			{{ Form::hidden('subcategoryActive', '', ['id'=>'subcategoryActive']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label producer_label']) }}
		@if(isset($pdf))
			{{ Form::select('producer_id', createOptions($producers, 'producer_id', 'producer'), $pdf->producer_id, ['class'=>'form-control producer_input', 'id'=>'producerSelect', 'required']) }}
		@else
			{{ Form::select('producer_id', createOptions($producers, 'producer_id', 'producer'), null, ['class'=>'form-control producer_input', 'id'=>'producerSelect', 'required']) }}
		@endif
	</div>
</div>
@if(isset($pdf))
	<div class="change_block change_item_title_block">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="file_div">
			{{ Form::label('file_old', 'Файл', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('file_old', $pdf->file, ['class'=>'mdl-textfield__input', 'id' => 'good', 'disabled']) }}
		</div>
	</div>
@else
	<div class="change_block change_item_title_block">
		<p class="admin_uni_label">Загрузить деталировку</p>
		{{Form::file('file', ['required'])}}
	</div>
@endif
<div class="change_item_buttons">
	<p class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent clear_item_button low_button">Очистить</p>
	{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
</div>