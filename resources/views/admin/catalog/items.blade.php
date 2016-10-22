@extends('admin.layout')
@extends('admin.partials.header')
@extends('admin.partials.drawer')
@extends('admin.modals.change-item-subcategory')
@extends('admin.modals.change-item-procurement')
@extends('admin.modals.add-item-to-pdf')

@section('body')
{{--	@include('partials/flash_messages')--}}
	<div class="new_admins_list--items mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="selected_quantity_fixed_main">
			<div class="selected_quantity_fixed" data-spy="affix" data-offset-top="84">
				<p class="selected_quantity">0 элементов</p>
				<div class="select_btns_div">
					<a class="select_all_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
						Выбрать все
					</a>
					<a class="deselect_all_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
						Отменить все
					</a>
				</div>
			</div>
		</div>
		<h1 class="admin_uni_heading">Каталог</h1>
		<h2 class="admin_uni_heading head_right">
			@if ($env=='byproducer')
				{{$current->producer}}
			@elseif ($env == 'search')
				{{ $current }}
			@else
				{{substr($current->category,0, -3)}}
				@if (substr($current->category, -3) === "_en")
					(импортное)
				@else
					(российское)
				@endif
			@endif
		</h2>
		@if ($env !=='byproducer' && $env !=='search')
			<p class="hidden" id="categoryActive">{{$current->category}}</p>
			<p class="hidden" id="subcategoryActive">{{$current->subcat_id}}</p>
		@endif
		<div class="admin_main_content admin_main_content_items">
			@include('user-interface.partials.items.items-sorting')

			@foreach ($items as $item)
				@include('admin.catalog.item-for-catalog')
			@endforeach
		</div>
		<div class="admin_items_footer_main">
			<div class="admin_items_footer">
				<div class="change_items_buttons_first">
					<!-- Accent-colored raised button with ripple -->
					<a class="admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ajax_change_state"
					   data-url="{{route('ajax_special')}}">
						Добавить в спецпредложения
					</a>
					<a class="admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ajax_change_state"
					   data-url="{{route('ajax_hit')}}">
						Сделать хитом продаж
					</a>
					<a class="admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
					   data-toggle="modal"
					   data-target="#changeProcurement">
						Изменить наличие
					</a>
				</div>
				<div class="change_items_buttons_second">
					<a class=" admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
					   data-toggle="modal"
					   data-target="#changeSubcat">
						Изменить категорию/подкатегорию
					</a>
					<a class=" admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored add_to_pdf"
					   data-toggle="modal"
					   data-target="#addToPdf">
						Добавить/удалить ссылки к PDF
					</a>
					@if(Auth::guard('admin')->user()->master)
						<a class=" admin_footer_btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored delete_group_button" data-url="{{route('delete_group')}}">Удалить товары</a>
					@endif
				</div>
			</div>
		</div>
		@if($env !=='search')
			{{$items->appends([
				'subcat_id' => $current->subcat_id,
				'sort' => request()->get('sort'),
				'order' => request()->get('order'),
				'pages_by' => request()->get('pages_by')
				])->links()}}
		@else
			{{$items->links()}}
		@endif
	</div>
	<div class="add_btn" id="add_btn">
		<a href="{{route('add_item')}}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">add</i>
		</a>
	</div>
	<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
		Добавить товар
	</div>
@stop

@section('page-js')
	{{ Html::script('js/admin/group-editing.js') }}
	{{ Html::script('js/admin/trigger-delete-form.js') }}
	{{ Html::script('js/admin/cookie.js') }}
	{{ Html::script('js/user-interface/order.js') }}
	{{ Html::script('js/user-interface/sort.js') }}
@stop