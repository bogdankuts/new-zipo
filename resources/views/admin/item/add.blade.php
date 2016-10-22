@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content--change-item mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($item, ['url'=>route('save_item'), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
			@include('admin.item._form')
		{{ Form::close() }}
	</div>
@stop
@section('page-js')
	{{Html::script('js/admin/load-subcategories.js')}}
	{{Html::script('js/admin/item-clear.js')}}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/image-upload.js')}}
	<script>
		jQuery(function($){ $('.producer_input--producer').chosen(); });
	</script>
@stop