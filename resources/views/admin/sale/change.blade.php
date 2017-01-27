@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')

@section('css')
	{{ Html::style('js/admin/vendor/date-time/css/datepicker.min.css') }}
@stop

@section('body')
	<div class="admin_main_content admin_main_content--producers change-pdf mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col pdf">
		{{ Form::model($sale, ['url'=>route('update_sale', [$sale->id]), 'class'=>'update_item_form', 'method'=>'POST', 'files' => 'false']) }}
		@include('admin.sale._form')
		{{ Form::close() }}
		@if (Auth::guard('admin')->user()->master)
			{{ Form::open(['url'=>route('delete_sale', [$sale->id]), 'method'=>'POST', 'class'=>'admin_panel_import admin-delete-sale']) }}
			{{ Form::submit('Удалить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent admin_uni_button btn_del delete_items_group_icon']) }}
			{{ Form::close() }}
		@endif
		<p class="subheading-items-in-sale">Товары в распродаже</p>
		<div class="items-in-sale">
			@forelse($items as $item)
				<div class="empty_scape">
					@if ($item->hit&&$item->special)
						{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
						{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
					@elseif ($item->hit)
						{{ Html::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
					@elseif ($item->special)
						{{ Html::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
					@endif
					<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one admin_items"><!--last class is for admin css-->
						<div class="admin_items_buttons">
							@if(Auth::guard('admin')->user()->master)
								<div class="delete-from-sale">
									{{ Form::open(array('url' => route('delete_from_sale', [$item->item_id]), 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
									<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect js_trigger_closet_form">
										<i class="material-icons">close</i>
									</button>
									{{ Form::close() }}
								</div>
							@endif
						</div>
						<div class="items_item_text_block">
							<div class="items_item_heading">
								<div class="name_and_code">
									<div class="items_item_name_div">
										<p class="items_item_name">{{$item->title}}</p>
										<p class="items_item_name_full">{{$item->title}}</p>
									</div>
								</div>
								<div class="items_item_code_div">
									<p class="items_item_code">Арт: {{$item->code}}</p>
									<p class="items_item_code_full">Арт: {{$item->code}}</p>
								</div>
								@if ($item->price == 0.00)
									<div class="items_item_price_div">
										<p class="items_item_price">По запросу&nbsp</p>
										<p class="items_item_currency"></p>
									</div>
								@else
									<div class="items_item_price_div">
										<p class="items_item_price">{{$item->price}}&nbsp</p>
										<p class="items_item_currency">руб.</p>
									</div>
								@endif
							</div>
							<div class="items_item_descript">
								{{ Html::image("img/photos/items/$item->photo", "$item->title", ['class'=>'items_page_item_img']) }}
								<table class="items_item_text">
									<tr>
										<td colspan='2' class="small_heading">Характеристики</td>
									</tr>
									<tr>
										<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
										<td class="items_item_dyn_text">{{$item->producer}}</td>
									</tr>
									<tr>
										<td>Код:</td>
										<td class="items_item_dyn_text">{{$item->code}}</td>
									</tr>
									<tr>
										<td>Тип:&nbsp</td>
										<td class="items_item_dyn_text">{{$item->subcat}}</td>
									</tr>
									<tr>
										<td>Наличие:&nbsp</td>
										<td class="items_item_dyn_text">{{$item->supply_title}}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			@empty
				<p>Пока нет товаров в этой распродаже</p>
			@endforelse
		</div>
	</div>
@stop
@section('page-js')
	{{ Html::script('js/admin/vendor/date-time/js/datepicker.min.js') }}
	{{Html::script('js/admin/vendor/jquery.ui.widget.js') }}
	{{Html::script('js/admin/vendor/jquery.fileupload.js') }}
	{{Html::script('js/admin/sale-image-upload.js')}}
@stop