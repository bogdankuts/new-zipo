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
		{{ Form::label('url', 'URL', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('url', $sale->url, ['class'=>'mdl-textfield__input', 'required', 'id' => 'url', 'maxlength'=>'128', 'disabled']) }}
		@else
			{{ Form::text('url', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'url', 'maxlength'=>'128', 'disabled']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('start_date', 'Начало', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('start_date', $sale->start_date, ['class'=>'mdl-textfield__input', 'required', 'id' => 'start_date', 'maxlength'=>'128', 'disabled']) }}
		@else
			{{ Form::text('start_date', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'start_date', 'maxlength'=>'128', 'disabled']) }}
		@endif
	</div>
</div>
<div class="change_block change_item_title_block">
	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="title_div">
		{{ Form::label('end_date', 'Конец', ['class'=>'mdl-textfield__label']) }}
		@if(isset($sale))
			{{ Form::text('end_date', $sale->end_date, ['class'=>'mdl-textfield__input', 'required', 'id' => 'end_date', 'maxlength'=>'128', 'disabled']) }}
		@else
			{{ Form::text('end_date', null, ['class'=>'mdl-textfield__input', 'required', 'id' => 'end_date', 'maxlength'=>'128', 'disabled']) }}
		@endif
	</div>
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