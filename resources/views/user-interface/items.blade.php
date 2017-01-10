@extends('user-interface.layout')
@include('user-interface.partials.initial-meta')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@if ($env != 'specials' && $env != 'search')
	@section('meta')
		<title>Запчасти подкатегории: {{$current->subcat}}</title>
		<meta name='keywords' content='Запчасти подкатегории: {{$current->subcat}} - Зип Общепит'>
		<meta name='description' content='Запчасти подкатегории: {{$current->subcat}} - Зип Общепит'>
	@stop
@endif

@section('body')
	<div class="main_content">
		@include('user-interface.partials.items.items-breadcrumbs')
		<hr class="main_hr">
		@include('user-interface.partials.items.items-sorting')

		@foreach ($items as $item)
			@include('user-interface.partials.items.one-item')
		@endforeach
		@if($env == 'specials')
			{{$items->appends([
				'sort' => request()->get('sort'),
				'order' => request()->get('order'),
				'pages_by' => request()->get('pages_by')
				])->links()}}
		@elseif($env == 'prods_by_subcat')
			{{$items->appends([
				'subcat_id' => $current->subcat_id,
				'producer_id' => $producer->producer_id,
				'sort' => request()->get('sort'),
				'order' => request()->get('order'),
				'pages_by' => request()->get('pages_by')
				])->links()}}
		@elseif($env == 'search')
			{{$items->appends([
				'query' => $current,
				'sort' => request()->get('sort'),
				'order' => request()->get('order'),
				'pages_by' => request()->get('pages_by')
				])->links()}}
		@endif

		@include('user-interface.partials.items.items-pagination')

	</div>
@stop

@section('page-js')
	{{Html::script('js/user-interface/sort.js')}}
	{{Html::script('js/user-interface/pagesBy.js')}}
@stop
