@extends('user-interface.layout')
@extends('user-interface.partials.header')
@extends('user-interface.partials.left-sidebar')
@extends('user-interface.partials.right-sidebar')
@extends('user-interface.partials.footer')

@section('meta')
	<title>Зип Общепит - Заказ</title>
	<meta name='keywords' content='Страница заказа'>
	<meta name='description' content='Страница заказа'>
@stop

@section('body')
	<div class="main_content">
		<h2 class="order_heading universal_heading">Форма заказа</h2>
		<hr class="main_hr">
		@if($step != 5)
			@include('user-interface.order._cart-contains')
		@endif

		@if($step == 1)
			@include('user-interface.order._client-info')
		@elseif($step == 2)
			@include('user-interface.order._form-of-business')
		@elseif($step == 3)
			@include('user-interface.order._payment-method')
		@elseif($step == 4)
			@include('user-interface.order._delivery-method')
		@else
			@include('user-interface.order._summary')
		@endif
	</div>
@stop

@section('page-js')
	{{Html::script('js/user-interface/order.js')}}
	{{Html::script('js/user-interface/mask.js')}}
@stop