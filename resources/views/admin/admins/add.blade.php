@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="admin_panel_pdf_div">
			{{ Form::model($admin, ['url'=>route('save_admin'), 'files'=>false, 'method'=>'POST', 'class'=>'admin_panel_import_pdf']) }}
				@include('admin.admins._form')
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent submit_admin']) }}
			{{ Form::close() }}
		</div>
	</div>
@stop