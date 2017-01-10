@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Запчасти акции: {{$sale->title}}</title>
	<meta name='keywords' content='Запчасти акции: {{$sale->title}} - Зип Общепит'>
	<meta name='description' content='Запчасти акции: {{$sale->title}} - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<div class="sale-heading">
			<h2>{{$sale->title}}</h2>
			@if(!is_null($sale->description))
				<p>{!! $sale->description !!}</p>
			@endif
		</div>
		<hr class="main_hr">
		@if(!$items->isEmpty())
			@include('user-interface.partials.items.items-sorting')
		
			@foreach ($items as $item)
				@include('user-interface.partials.items.one-item')
			@endforeach
		
			@include('user-interface.partials.items.items-pagination')
		@else
			<p class="sorry-message">Пока нет товаров в этой акции или они все проданы! Загляните сюда попозже.</p>
		@endif
	
	</div>
@stop

@section('page-js')
	{{Html::script('js/user-interface/sort.js')}}
	{{Html::script('js/user-interface/pagesBy.js')}}
@stop
