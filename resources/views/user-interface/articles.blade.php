@extends('user-interface.layout')
@include('user-interface.partials.initial-meta')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="{{route('index')}}">Главная</a></li>
			<li class="active">Новости</li>
		</ol>
		<h3 class="articles_main_header universal_heading">Новости</h3>
		<hr class="main_hr">
		@foreach ($allArticles as $article)
			<div class="articles_one">
				<div class="article_preview">
					<div class="article_photo_preview_div">
						{{ Html::image("img/photos/articles/$article->photo", "$article->title", ['class'=>'articles_minimg']) }}
					</div>
					<h2 class="article_preview_header">{{ $article->title }}</h2>
					<p class="article_one_date">{{ formatDate($article->time) }}</p>
					<div class="articles_text">{!! $article->body !!}</div>
					<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="articles_button_read btn btn-default">
						Читать
					</a>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
@stop