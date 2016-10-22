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
			<li class="active">Прайс-лист</li>
		</ol>
		<h2 class="prices_heading universal_heading">Прайс-листы</h2>
		@foreach($prices as $key => $price)
			<div class="price_load">
				<a href="{{route('price')."?price_id=$key"}}" class="prices_price_name btn btn-default col-lg-6 btn-block">
					<i class="fa fa-table fa-lg"></i>
					{{$price}}
				</a>
			</div>
		@endforeach
	</div>
@stop