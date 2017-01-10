@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content--change-article mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{ Form::model($article, ['url'=> route('save_article'), 'method'=>'POST', 'class'=>'article_update_form']) }}
			@include('admin.articles._form')
		{{ Form::close() }}
	</div>
@stop

@section('page-js')
	{{Html::script('ckeditor/ckeditor.js') }}
	{{Html::script('js/admin/article-clear.js')}}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/article-image-upload.js')}}
	@include('admin.articles._editor-init')
@stop