@section('right_sidebar')
	<div class="right_sidebar">
		<div class="container_sidebar">
			<div class="articles">
				<a href="{{route('articles')}}" class="articles_heading">Новости</a>
				@foreach ($articles as $article)
					<div class="article">
						<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="article_link">
							<img src="/img/photos/articles/{{$article->photo}}" alt="{{$article->title}}" class="article_minimage">
						</a>
						<p class="right_sidebar_article_date">{{formatDate($article->time)}}</p>
						@if (strLen($article->title) <=60)
							<div class="article_title">
								<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="article_title_1">
									{{$article->title}}
								</a>
								<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="article_title_1 article_title_full">
									{{$article->title}}
								</a>
							</div>
						@else
							<div class="article_title">
								<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="article_title_1">
									{{mb_substr ($article->title, 0, 27)}} ...
								</a>
								<a href="{{route('article', [str_slug($article->title)])."?article_id=$article->article_id"}}" class="article_title_1 article_title_full">
									{{$article->title}}
								</a>
							</div>
						@endif
					</div>
				@endforeach
				<a href="{{route('articles')}}" class="articles_all_link">Все новости >> </a>
			</div>
		</div>
	</div>
@stop
