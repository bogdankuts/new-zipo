@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="admin_panel_pdf_div">
			{{ Form::model($admin, ['url'=>route('update_admin', [$admin->cred_id]), 'files'=>false, 'method'=>'POST', 'class'=>'admin_panel_import_pdf admin_change_admin']) }}
			@include('admin.admins._form')
			{{ Form::submit('Сохранить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent submit_admin']) }}
			{{ Form::close() }}
			<div class="change_admin_delete">
				@if (Auth::guard('admin')->user()->master)
					{{ Form::open(['url'=>route('delete_admin', [$admin->cred_id]), 'method'=>'POST', 'class'=>'admin_panel_import admin_delete_form']) }}
						{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
					{{ Form::close() }}
				@endif
			</div>
		</div>
	</div>
@stop