@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($producer, ['url'=>route('producer_update', [$producer->producer_id]), 'class'=>'update_item_form update_producer_form', 'method'=>'POST', 'files' => 'true']) }}
			@include('admin.producers._form')
		{{ Form::close() }}
		<div class="change_item_delete change_producer_delete">
			@if (Auth::guard('admin')->user()->master)
				{{ Form::open(['url'=>route('producer_delete', [$producer->producer_id]), 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
					{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			@endif
		</div>
	</div>
@stop

@section('page-js')
	{{Html::script('js/admin/producer-clear.js')}}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/producer-image-upload.js')}}
@stop

