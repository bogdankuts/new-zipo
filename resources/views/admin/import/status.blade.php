@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="import_status_content">
			{!! $time !!}
			{!! $mempeak !!}
			<hr>
			<span style="color:blue">Импорт завершен, было добавлено {{ $added }} товаров</span>
			<hr>
			<span style="color:red">{{ $missed }} товаров не было добавлено. Ошибки:</span>
			{{ Html::ul($importErrors, ['style' => 'color:red']) }}
			<hr>
			<span style="color:green">Уведомления:</span>
			{{ Html::ul($importMessages, ['style' => 'color:green']) }}
		</div>
	</div>
@stop