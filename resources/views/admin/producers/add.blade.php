@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($producer, ['url'=>route('producer_save'), 'class'=>'update_producer_form', 'method'=>'POST', 'files' => 'true']) }}
			@include('admin.producers._form')
		{{ Form::close() }}
	</div>
@stop

@section('page-js')
	{{Html::script('js/admin/producer-clear.js')}}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/producer-image-upload.js')}}
@stop
