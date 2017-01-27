@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('css')
	{{ Html::style('js/admin/vendor/date-time/css/datepicker.min.css') }}
@stop
@section('body')
	<div class="admin_main_content admin_main_content--producers change-pdf mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($sale, ['url'=>route('save_sale'), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
		@include('admin.sale._form')
		{{ Form::close() }}
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/vendor/date-time/js/datepicker.min.js') }}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/sale-image-upload.js')}}
@stop