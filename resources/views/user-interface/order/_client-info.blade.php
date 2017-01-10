<p class="step-title">Шаг 1 из 5 - Контактные данные</p>
{{Form::open(['url' => route('store_order'), 'method'=>'POST', 'files' => true, 'class'=>'order_form'])}}
	<div class="general_info">
		{{ Form::label('name', 'Имя: ', ['class'=>'main_label req']) }}
		@if (Auth::user())
			{{ Form::text('name', Auth::user()->name, ['class'=>'change_input form-control', 'required']) }}
		@else
			{{ Form::text('name', null, ['class'=>'change_input form-control', 'required']) }}
		@endif
		{{ Form::label('surname', 'Фамилия: ', ['class'=>'main_label req']) }}
		@if (Auth::user())
			{{ Form::text('surname', Auth::user()->surname, ['class'=>'change_input form-control', 'requierd']) }}
		@else
			{{ Form::text('surname', null, ['class'=>'change_input form-control', 'requierd']) }}
		@endif
		{{ Form::label('phone', 'Телефон: ', ['class'=>'main_label req']) }}
		@if (Auth::user())
			{{ Form::text('phone', Auth::user()->phone, ['class'=>'change_input change_input_code form-control', 'required', 'data-mask' => '+7 (000) 000-00-00']) }}
		@else
			{{ Form::text('phone', null, ['class'=>'change_input change_input_code form-control', 'required', 'data-mask' => '+7 (000) 000-00-00', 'placeholder' => '+7 (812) 987 08 81']) }}
		@endif
		{{ Form::label('email', 'E-Mail: ', ['class'=>'main_label req']) }}
		@if (Auth::user())
			{{ Form::email('email', Auth::user()->email, ['class'=>'change_input change_input_code form-control', 'required']) }}
		@else
			{{ Form::email('email', null, ['class'=>'change_input change_input_code form-control', 'required']) }}
		@endif
		{{ Form::label('company', 'Компания: ', ['class'=>'main_label']) }}
		@if (Auth::user())
			{{ Form::text('company', Auth::user()->company, ['class'=>'change_input change_input_code form-control',]) }}
		@else
			{{ Form::text('company', null, ['class'=>'change_input change_input_code form-control',]) }}
		@endif
		{{Form::hidden('step', 1)}}
	</div>
	{{Form::submit('Далее', ['class'=>'submit_field save_button btn'])}}
{{Form::close()}}
