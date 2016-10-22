@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Деталлировки производителей</title>
	<meta name='keywords' content='Деталлировки производителей - Зип Общепит'>
	<meta name='description' content='Деталлировки производителей  - Зип Общепит'>
@stop
@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="{{route('index')}}">Каталог</a></li>
			<li class="active">Все деталировки</li>
		</ol>
		<h4 class="universal_heading">Все деталировки по категориям</h4>
		<hr class="main_hr">
		<div class="catalog_categories">
			@foreach(['en', 'ru'] as $lang)
				<div class="catalog">
					<h4 class="catalog_part_heading">
						@if($lang =='en')
							Импортное
						@else
							Отечественное
						@endif
					</h4>
					@foreach(array_chunk($categories[$lang], 2) as $categoryArray)
						@foreach($categoryArray as $category)
							@include('user-interface.partials.catalog.catalog-categories')
						@endforeach
						@foreach($categoryArray as $category)
							@include('user-interface.partials.pdf.pdf-producers')
						@endforeach
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
@stop
