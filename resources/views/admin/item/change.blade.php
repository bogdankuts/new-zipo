@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content--change-item mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($item, ['url'=>route('update_item', [$item->item_id]), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
		@include('admin.item._form')
		{{ Form::close() }}
		<div class="change_item_delete">
			@if (Auth::guard('admin')->user()->master)
				{{ Form::open(['url'=>route('delete_item', [$item->item_id]), 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
					{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			@endif
		</div>
	</div>
@stop
@section('page-js')
	{{Html::script('js/admin/load-subcategories.js')}}
	{{Html::script('js/admin/item-clear.js')}}
	{{ HTML::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{ HTML::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/image-upload.js')}}
	<script>
		jQuery(function($){ $('.producer_input--producer').chosen(); });
	</script>
@stop