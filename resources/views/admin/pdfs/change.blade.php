@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--producers change-pdf mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($pdf, ['url'=>route('update_pdf', [$pdf->pdf_id]), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
			@include('admin.pdfs._form')
		{{ Form::close() }}
		<div class="change_item_delete">
			@if (Auth::guard('admin')->user()->master)
				{{ Form::open(['url'=>route('delete_pdf', [$pdf->pdf_id]), 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
				{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
				{{ Form::close() }}
			@endif
		</div>
		<div class="add_btn" id="add_btn">
			<a href="{{route('create_pdf')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить деталировку
		</div>
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/pdf-clear.js') }}
	{{ Html::script('js/admin/load-subcategories.js') }}
	<script>
		jQuery(function($){ $('#producerSelect').chosen(); });
	</script>w
@stop