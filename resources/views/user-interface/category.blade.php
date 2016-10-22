@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Зип Общепит - категория</title>
	<meta name='keywords' content=' купить в Санкт-Петербурге'>
	<meta name='description' content='Категория - '>
@stop
@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="/">Каталог</a></li>
			<li class="active">{{reverseSlug($category)}} оборудование</li>
		</ol>
		<h2 class="one_category_heading universal_heading">{{reverseSlug($category)}} оборудование</h2>
		<hr class="main_hr">
		<ul class="subcats">
			@foreach ($subcats as $subcat)
				<li class="subcat">
					<a href="{{route('producers_by_subcat', [str_slug($subcat->category), str_slug($subcat->subcat)])."?subcat_id=$subcat->subcat_id"}}">
						{{$subcat->subcat}}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
@stop