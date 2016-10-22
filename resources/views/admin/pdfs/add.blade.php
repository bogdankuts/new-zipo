@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--producers change-pdf mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($pdf, ['url'=>route('save_pdf'), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'true']) }}
			@include('admin.pdfs._form')
		{{ Form::close() }}
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
	</script>
@stop