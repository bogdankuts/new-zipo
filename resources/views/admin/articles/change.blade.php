@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	{{--	@include('partials/flash_messages')--}}
	<div class="admin_main_content--change-article mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($article, ['url'=> route('article_update', [$article->article_id]), 'method'=>'POST', 'class'=>'article_update_form']) }}
			@include('admin.articles._form')
		{{ Form::close() }}
		@if (Auth::guard('admin')->user()->master)
			{{ Form::open(['url'=>route('delete_article', [$article->article_id]), 'method'=>'POST', 'class'=>'admin_panel_import']) }}
				{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
			{{ Form::close() }}
		@endif
	</div>
@stop
@section('page-js')
	{{Html::script('ckeditor/ckeditor.js') }}
	{{Html::script('js/admin/ckeditor-init.js')}}
	{{Html::script('js/admin/article-clear.js')}}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/article-image-upload.js')}}
@stop