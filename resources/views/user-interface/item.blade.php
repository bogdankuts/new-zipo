@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	@if($item->meta_title !== '')
		<title>Зип Общепит - {{ $item->meta_title }}</title>
	@else
		<title>Зип Общепит - {{ $item->title }}</title>
	@endif
	<meta name='keywords' content='{{ $item->producer }} - {{ $item->title }} купить в Санкт-Петербурге'>
	@if($item->meta_description !== '')
		<meta name='description' content='{{$item->meta_description}}'>
	@else
		<meta name='description' content='{{ $item->producer }} - {{ $item->title }}. {{ $item->description }}'>
	@endif
@stop

@section('css')
	<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
			<li><a href="{{route('index')}}">Каталог</a></li>
			<li>
				<a href="{{route('category', [str_slug($item->category)])}}">
					{{substr($item->category, 0, -3)}}
				</a>
			</li>
			<li>
				<a href="{{route('producers_by_subcat', [str_slug($item->category), str_slug($item->subcat)])."?subcat_id=$item->subcat_id"}}">
					{{$item->subcat}}
				</a>
			</li>
			<li class="active">{{$item->title}}</li>
		</ol>
		<div class="item_page item_{{$item->item_id}}">
			<div class="item_page_heading">
				<h3 class="items_main_header universal_heading">{{$item->title}}</h3>
				<!-- <p class="item_page_name">{{$item->title}}</p> -->
				<p class="item_page_code">Артикул: {{$item->code}}</p>
				@if($item->price == 0.00)
					<div class="item_price_div">
						<p class="item_page_price up_letter">По запросу&nbsp</p>
						<p class="item_page_currency"></p>
					</div>
				@else
					<div class="item_price_div">
						@if(!$item->activeSales->isEmpty())
							<div class="old">
								<p class="item_page_price">{{ceil($item->price)}}&nbsp</p>
								<p class="item_page_currency">руб.</p>
							</div>
							<p class="item_page_price">{{salesPrice($item->price, $item->activeSales[0]->discount)}}&nbsp</p>
						@elseif (Auth::user())
							<p class="item_page_price">{{discount_price($item->price)}}&nbsp</p>
						@else
							<p class="item_page_price">{{$item->price}}&nbsp</p>
						@endif
						<p class="item_page_currency">руб.</p>
					</div>
				@endif
			</div>
			<div class="item_page_descript">
				@if(count($photos) > 0)
					<div class="fotorama"
						 data-allowfullscreen="true"
						 data-nav="thumbs"
						 data-fit="contain"
						 data-loop="true"
						 data-keyboard="true"
						 data-arrows="true"
						 data-click="true"
						 data-swipe="false"
						 data-width="242">
						@if($item->photo != "no_photo.png")
							{{ Html::image("img/photos/items/$item->photo", "$item->title", ['class'=>'items_item_img']) }}
						@endif
						@foreach($photos as $photo)
							<img src="/img/photos/items/{{$item->item_id}}/{{$photo->photo_title}}" alt="">
						@endforeach	
					</div>
				@else
					{{ Html::image("img/photos/items/$item->photo", "$item->title", ['class'=>'items_item_img']) }}
				@endif
				<table class="item_page_text">
					<tr>
						<td colspan='2'>Характеристики</td>
					</tr>
					<tr>
						<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
						<td>{{$item->producer}}</td>
					</tr>
					<tr>
						<td>Код:</td>
						<td>{{$item->code}}</td>
					</tr>
					<tr>
						<td>Тип:&nbsp</td>
						<td>{{$item->subcat}}</td>
					</tr>
					<tr>
						<td>Наличие:&nbsp</td>
						<td>{{$item->supply_title}}</td>
					</tr>
				</table>
			</div>
			<div class="item_page_descr">
				<p class="item_page_descr_title">Описание:</p>
				<p class="item_page_descr_p">{!! $item->description !!}</p>
			</div>
			@if(!$item->activeSales->isEmpty())
				<a href="" class="item_order btn btn-default js_item_add" data-id="{{$item->item_id}}" data-price="{{salesPrice($item->price, $item->activeSales[0]->discount)}}">В корзину</a>
			@elseif (Auth::user())
				<a href="" class="item_order btn btn-default js_item_add" data-id="{{$item->item_id}}" data-price="{{discount_price($item->price)}}">В корзину</a>
			@else
				<a href="" class="item_order btn btn-default js_item_add" data-id="{{$item->item_id}}" data-price="{{$item->price}}">В корзину</a>
			@endif
			<a href="{{route('cart')}}" class="btn btn-default item_order item_order--delete js_item_cart">Корзина</a>
			<a href="{{route('contacts')}}#contact_sorm_ancher" class="item_more btn btn-default">Задать вопрос</a>
			<a href="{{route('delivery')}}" class="item_more item_more_delivery btn btn-default">Условия доставки</a>

			@include('user-interface.partials.items.item-recommended')

		</div>
	</div>
@stop

@section('page-js')
	<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
@stop