@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('body')
	<div class="admin_main_content admin_main_content--producers pdfs mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach ($sales as $sale)
			<div class="mdl-card mdl-shadow--2dp one_pdf" id="{{$sale->id}}">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">{{$sale->title}}</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="line">
						<p class="heading">Просмотр на сайте</p>
						<a href="{{route('one_sale', [$sale->url])}}" class="value" target="_blank">Посомтреть</a>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<a href="{{route('change_sale_page', [$sale->id])}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
				</div>
				<div class="mdl-card__menu">
					<button id="{{$sale->id}}-menu-trigger"
							class="mdl-button mdl-js-button mdl-button--icon">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="{{$sale->id}}-menu-trigger">
						<a href="{{route('change_sale_page', [$sale->id])}}"class="mdl-menu__item">
							Изменить
						</a>
						@if (Auth::guard('admin')->user()->master)
							{{--<li class="mdl-menu__item delete_pdf" data-id="{{$sale->id}}" data-url="{{route('delete_sale', [$sale->id])}}">--}}
								{{--<p>Удалить</p>--}}
							{{--</li>--}}
						@endif
					</ul>
				</div>
			</div>
		@endforeach
		{{--<div class="add_btn" id="add_btn">--}}
			{{--<a href="{{route('create_sale')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">--}}
				{{--<i class="material-icons">add</i>--}}
			{{--</a>--}}
		{{--</div>--}}
		{{--<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">--}}
			{{--Добавить распродажу--}}
		{{--</div>--}}
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/pdfs.js') }}
@stop