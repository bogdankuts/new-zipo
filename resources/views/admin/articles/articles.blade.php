@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="new_admins_list--items mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{--<a href="/admin/change_article" class="admin_article_add"><i class="fa fa-plus"></i>Добавить новость</a>--}}
		@foreach ($articles as $article)
			<div class="admin_articles_one">
				<div class="article_more">
					<!-- Right aligned menu below button -->
					<button id="{{$article->article_id}}-menu-trigger" class="mdl-button mdl-js-button mdl-button--icon admin_item_menu_trigger">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="{{$article->article_id}}-menu-trigger">
						{{--<li class="mdl-menu__item">--}}
						<a href='{{route('article_change', [$article->article_id])}}' class="mdl-menu__item">
							Изменить
						</a>
						{{--</li>--}}
						@if(Auth::guard('admin')->user()->master)
							{{ Form::open(array('url' => route('delete_article', [$article->article_id]), 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
							<li class="mdl-menu__item js_trigger_closet_form">
								Удалить
							</li>
							{{ Form::close() }}
						@endif
					</ul>
				</div>
				<div class="img_block">
					<a href='{{route('article_change', [$article->article_id])}}' class="article_link">
						<img src="/img/photos/articles/{{$article->photo}}" alt="{{$article->title}}" class="admin_article_minimg">
					</a>
				</div>
				<p class="admin_article_date">
					{{$article->time}}&nbsp&nbsp&nbsp
				</p>
				@if (strLen($article->title) <=60)
					<div class="admin_article_title">
						<a href='{{route('article_change', [$article->article_id])}}' class="admin_article_title_1">{{$article->title}}</a>
						<a href='{{route('article_change', [$article->article_id])}}' class="admin_article_title_1 admin_article_title_full">{{$article->title}}</a>
					</div>
				@else
					<div class="admin_article_title">
						<a href='{{route('article_change', [$article->article_id])}}' class="admin_article_title_1">{{mb_substr ($article->title, 0, 27)}} ...</a>
						<a href='{{route('article_change', [$article->article_id])}}' class="admin_article_title_1 admin_article_title_full">{{$article->title}}</a>
					</div>
				@endif
			</div>
		@endforeach
		<div class="add_btn" id="add_btn">
			<a href="{{route('add_article')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
				<i class="material-icons">add</i>
			</a>
		</div>
		<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
			Добавить новость
		</div>
	</div>
@stop

@section('page-js')
	{{Html::script('js/admin/trigger-delete-form.js')}}
@stop