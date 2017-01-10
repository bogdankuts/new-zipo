@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list settings-page mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col about">
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Скидка для зарегистрированных пользователей</h4>
			{{ Form::open(['url' => route('set_discount'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('discount', 'Дисконт', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('discount', $discount, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discount']) }}
				{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
			</div>
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Скидка при оплате картой</h4>
			{{ Form::open(['url' => route('set_discount_card'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('discountCard', 'Скидка', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('discountCard', $discountCard, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discountCard']) }}
				{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
			</div>
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Часы работы</h4>
			{{ Form::open(['url' => route('set_time'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_week_from', 'Время по будням с', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('time_week_from', $timeWeekFrom, ['class'=>'mdl-textfield__input', 'required', 'id' => 'time_week_from']) }}
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_week_to', 'Время по будням по', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('time_week_to', $timeWeekTo, ['class'=>'mdl-textfield__input', 'required', 'id' => 'time_week_to']) }}
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_sat_from', 'Время по субботам с', ['class'=>'mdl-textfield__label']) }}
				@if($timeSatFrom != '')
					{{ Form::text('time_sat_from', $timeSatFrom, ['class'=>'mdl-textfield__input', 'id' => 'time_sat_from']) }}
				@else
					{{ Form::text('time_sat_from', null, ['class'=>'mdl-textfield__input', 'id' => 'time_sat_from']) }}
				@endif
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_sat_to', 'Время по субботам по', ['class'=>'mdl-textfield__label']) }}
				@if($timeSatTo != '')
					{{ Form::text('time_sat_to', $timeSatTo, ['class'=>'mdl-textfield__input', 'id' => 'time_sat_to']) }}
				@else
					{{ Form::text('time_sat_to', null, ['class'=>'mdl-textfield__input', 'id' => 'time_sat_to']) }}
				@endif
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_sun_from', 'Время по восресеньям с', ['class'=>'mdl-textfield__label']) }}
				@if($timeSunFrom != '')
					{{ Form::text('time_sun_from', $timeSunFrom, ['class'=>'mdl-textfield__input', 'id' => 'time_sun_from']) }}
				@else
					{{ Form::text('time_sun_from', null, ['class'=>'mdl-textfield__input', 'id' => 'time_sun_from']) }}
				@endif
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('time_sun_to', 'Время по воскресеньям по', ['class'=>'mdl-textfield__label']) }}
				@if($timeSunTo != '')
					{{ Form::text('time_sun_to', $timeSunTo, ['class'=>'mdl-textfield__input', 'id' => 'time_sun_to']) }}
				@else
					{{ Form::text('time_sun_to', null, ['class'=>'mdl-textfield__input', 'id' => 'time_sun_to']) }}
				@endif
			</div>
			<div class="actions">
				{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
				{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			</div>
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Контактные телефоны</h4>
			{{ Form::open(['url' => route('set_phones'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('main_phone', 'Основной номер', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('main_phone', $p_phone->value, ['class'=>'mdl-textfield__input', 'required', 'id' => 'main_phone']) }}
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('secondary_phone', 'Дополнительный номер', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('secondary_phone', $s_phone->value, ['class'=>'mdl-textfield__input', 'required', 'id' => 'secondary_phone']) }}
			</div>
			{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Контактный email</h4>
			{{ Form::open(['url' => route('set_email'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('email', 'Контактный email', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('email', $email->value, ['class'=>'mdl-textfield__input', 'required', 'id' => 'email']) }}
			</div>
			{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Текущий курс евро<br />на {{Carbon\Carbon::now()->format('d-m-Y')}}</h4>
			{{ Form::open(['url' => route('set_eur_rate'), 'method' => 'POST', 'class'=>'admin_discount_input rate_input']) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('rate', 'Курс', ['class'=>'mdl-textfield__label']) }}
				{{ Form::number('rate', $rate, ['class'=>'mdl-textfield__input', 'required', 'id' => 'rate', 'step' => 0.0001]) }}
			</div>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="fixedRate">
				@if($rateIsFixed)
					{{ Form::checkbox('fixedRate', true, true, ['class'=>'mdl-switch__input', 'id'=>'fixedRate']) }}
				@else
					{{ Form::checkbox('fixedRate', true, false, ['class'=>'mdl-switch__input', 'id'=>'fixedRate']) }}
				@endif
				<span class="mdl-switch__label">Зафиксировать курс</span>
			</label>
			{{Form::hidden('changed_by', \Auth::guard('admin')->user()->cred_id)}}
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent current-rate-btn" id="js_get_current_rate">Получить текущий курс</a>
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Наценка</h4>
			{{ Form::open(['url' => route('set_markup'), 'method' => 'POST', 'class'=>'admin_discount_input']) }}
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('markup-less-10', 'Цена ниже 10 евро', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('markup-less-10', $markupLess10, ['class'=>'mdl-textfield__input', 'required', 'id' => 'markup-less-10']) }}
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('markup-10-25', 'Цена от 10 до 25 евро', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('markup-10-25', $markup1025, ['class'=>'mdl-textfield__input', 'required', 'id' => 'markup-10-25']) }}
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('markup-25-80', 'Цена от 25 до 80 евро', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('markup-25-80', $markup2580, ['class'=>'mdl-textfield__input', 'id' => 'markup-25-80']) }}
			</div>
			<div class="mdl-textfield time-block mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('markup-more-80', 'Цена выше 80 евро', ['class'=>'mdl-textfield__label']) }}
				{{ Form::text('markup-more-80', $markupMore80, ['class'=>'mdl-textfield__input', 'id' => 'markup-more-80']) }}
			</div>
			<div class="actions">
				{{ Form::hidden('changed_by', Auth::guard('admin')->user()->cred_id) }}
				{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
			</div>
			{{ Form::close() }}
		</div>
		<div class="settings_block mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Импорт</h4>
			{{ Form::open(['url'=>route('import'), 'files'=>true, 'method'=>'POST', 'class'=>'admin_panel_import']) }}
			{{ Form::file('excel', ['class'=>'admin_panel_input']) }}
			<div class="actions lower">
				{{ Form::submit('Импортировать', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent import_btn']) }}
				{{ Form::close() }}
				<a href="/import/zip.xlsx" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Загрузить пример прайса</a>
			</div>
		</div>
	</div>
@stop

@section('page-js')
	{{Html::script('js/admin/get-current-rate.js')}}
@stop